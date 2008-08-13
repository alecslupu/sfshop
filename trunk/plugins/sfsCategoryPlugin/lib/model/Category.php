<?php

/**
 * Subclass for representing a row from the 'categories' table.
 *
 * 
 *
 * @package plugins.sfsCategoryPlugin.lib.model
 */ 
class Category extends BaseCategory
{
    protected $parentTreeArray = array();
    
    
    
    /**
     * Gets thumbnail object for current product.
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
     * Gets child categories for current category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk
     * @access public
     */
    public function getChild($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        if ($this->getHasChild()) {
            $criteria->add(CategoryPeer::PARENT_ID, $this->getId());
            return CategoryPeer::doSelect($criteria);
        }
        else {
            return null;
        }
    }
    
    /**
     * Gets child categories for current category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk
     * @access public
     */
    public function getChildWithI18n($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        if ($this->getHasChild()) {
            $criteria->add(CategoryPeer::PARENT_ID, $this->getId());
            $criteria->addAscendingOrderByColumn(CategoryI18nPeer::TITLE);
            return CategoryPeer::doSelectWithTranslation($criteria);
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
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getChildSeries(&$childCategories)
    {
        $categories = $this->getChild();
        
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
    * Recursive function for gets all child categories.
    * 
    * @param  &$childCategories
    * @return null
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getChildSeriesWithI18n(&$childCategories)
    {
        $categories = $this->getChildWithI18n();
        
        if ($categories != null) {
            foreach ($categories as $category) {
                $childCategories[] = $category;
                $category->getChildSeriesWithI18n($childCategories);
            }
        }
        else {
            return null;
        }
    }
    
    /**
     * Returns array with parents series for current category.
     *
     * @param  &$array
     * @return array
     * @author Dmitry Nesteruk
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
     * @author Dmitry Nesteruk
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
     * Redefines save function.
     *
     * @param  void
     * @return void
     * @author Dmitry Nesteruk
     * @access public
     */
    public function save($con = null)
    {
        $changedParent = false;
        
        if (in_array(CategoryPeer::PARENT_ID, $this->modifiedColumns)) {
            $changedParent = true;
        }
        
        parent::save();
        
        if ($changedParent) {
            CategoryPeer::determinePathForCategoryAndChild($this);
        }
        
        CategoryPeer::determineHasChild();
    }
    
    public function getGeneratorEditTitle()
    {
        $title = $this->getTitle();
        
        if ($title == '')
        {
            $title = 'Add new category';
        } else {
            $title = 'Edit category &ldquo;' . sfsStringPeer::special($title) . '&rdquo;';
        }
        
        return $title;
    }
}
