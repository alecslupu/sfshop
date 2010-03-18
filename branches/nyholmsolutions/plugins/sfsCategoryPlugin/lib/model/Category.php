<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Subclass for representing a row from the 'categories' table.
 *
 * @package    plugin.sfsCategoryPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: Category.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class Category extends BaseCategory
{
    protected $parentTreeArray = array();
    
    public function __toString()
    {
        return $this->getTitle();
    }
    
    /**
     * Generate slug from title. Note! Slug is not persistant
     * Queries should depend on id.
     * 
     * @return string
     * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
     * @access public
     */
    public function getSlug()
    {
      return sfShop_Inflector::urlize($this->getTitle());
    }
        
    /**
     * Gets thumbnail object for category.
     * 
     * @param  string $type
     * @return object
     * @author Andrey Kotlyarov
     * @access public
     */
    public function getThumbnail($thumbnailType)
    {
        return ThumbnailPeer::retrieveByTypeAndAssetId($thumbnailType, $this->getId(), get_class($this));
    }
    
    /**
     * Gets child categories for category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public function getChild($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        if ($this->getHasChild()) {
            $criteria->add(CategoryPeer::PARENT_ID, $this->getId());
            $criteria->addAscendingOrderByColumn(CategoryPeer::POS);

            if ($withI18n) {
                return CategoryPeer::doSelectWithI18n($criteria);
            }
            else {
                return CategoryPeer::doSelect($criteria);
            }
        }
        else {
            return null;
        }
    }
    
   /**
    * Recursive function for gets all child categories.
    * 
    * @param  &$childCategories
    * @return null
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getChildSeries(&$childCategories, $withI18n = false)
    {
        $categories = $this->getChild(null, $withI18n);
        
        if ($categories != null) {
            foreach ($categories as $category) {
                $childCategories[] = $category;
                $category->getChildSeries($childCategories);
            }
        }
        else {
            return null;
        }
    }
    
    /**
     * Returns array with parents series for category.
     *
     * @param  &$array
     * @return array
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public function getParentsSeries(&$array)
    {
        $id = $this->getParentId();
        
        if ($id == null) {
            $array = array_reverse($array);
            return $array;
        }
        
        $category = CategoryPeer::retrieveByPK($id);
        
        if (is_object($category)) {
            $array[] = $category;
            $category->getParentsSeries($array);
        }
    }
    
    /**
     * Forming path to category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public function getPath()
    {
        if (parent::getPath() !== null) {
            return parent::getPath() . ',' . $this->getId();
        }
        else {
            return $this->getId();
        }
    }
    
    /**
     * Redefine save function.
     *
     * @param  void
     * @return void
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public function save(PropelPDO $con = null)
    {
        $changedParent = false;
        $changedActive = false;
        
        if ($this->isNew()) {
            if ($this->getParentId() == null) {
                $this->setIsParentActive(1);
                $this->setPath(null);
            } else {
                $parent = CategoryPeer::retrieveById($this->getParentId());
                $this->setIsParentActive($parent->getIsActive() && $parent->getIsParentActive() ? 1 : 0);
            }
        }
        
        if (in_array(CategoryPeer::PARENT_ID, $this->modifiedColumns)) {
            $changedParent = true;
        }
        
        if (in_array(CategoryPeer::IS_ACTIVE, $this->modifiedColumns)) {
            $changedActive = true;
        }
        
        parent::save();
        
        if ($changedParent) {
            CategoryPeer::determinePathForCategoryAndChild($this);
        }
        
        if ($changedActive) {
            CategoryPeer::determineIsParentActive($this);
        }
        
        CategoryPeer::determineHasChild();
    }
}
