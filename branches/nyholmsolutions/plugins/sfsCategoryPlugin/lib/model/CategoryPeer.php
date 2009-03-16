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
 * Subclass for performing query and update operations on the 'categories' table.
 *
 * @package    plugin.sfsCategoryPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: CategoryPeer.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class CategoryPeer extends BaseCategoryPeer
{
    
    
   /**
    * Gets all avaliable categories with parent_id 0.
    *
    * @param  void
    * @return array with objects, otherwise null.
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function getFirstLevel($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::PARENT_ID, null, Criteria::ISNULL);
        $criteria->addAscendingOrderByColumn(CategoryPeer::POS);
        return self::doSelectWithI18n($criteria);
    }
    
   /**
    * Gets array with all child's ids for category.
    * 
    * Returns ids of child categories for current category and all ids of child categories for his child.
    * 
    * @param  $categoryId
    * @return array with ids
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function getAllChildIds($categoryId)
    {
        $categories = self::getAllChild($categoryId);
        $ids = array();
        
        foreach ($categories as $category) {
            $ids[] = $category->getId();
        }
        
        return $ids;
    }
    
   /**
    * Gets all child categories for category.
    * 
    * Returns child categories for current category and all child categories for his child.
    * 
    * @param  $categoryId
    * @return array with ids
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function getAllChild($categoryId)
    {
        $category = self::retrieveByPK($categoryId);
        
        if ($category != null) {
            $childCategories = array();
            $category->getChildSeries($childCategories);
            return $childCategories;
        }
        else {
            return null;
        }
    }
    
   /**
    * Determines child exists for each category.
    * 
    * Set a field hasChild true if category has child, otherwise set 0.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function determineHasChild()
    {
        $criteria = new Criteria();
        self::addAdminCriteria($criteria);
        $categories = self::doSelect($criteria);
        
        foreach ($categories as $category) {
            $criteria = new Criteria();
            $criteria->add(self::PARENT_ID, $category->getId());
            
            $criteriaSet = new Criteria();
            
            if (self::doCount($criteria) > 0) {
                $criteriaSet->add(self::HAS_CHILD, 1);
            }
            else {
                $criteriaSet->add(self::HAS_CHILD, 0);
            }
            
            $criteriaWhere = new Criteria();
            $criteriaWhere->add(self::ID, $category->getId());
            
            BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
        }
        
    }
    
   /**
    * Determines a path for each category.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function determinePathForCategoryAndChild($category)
    {
        $categories = array();
        $category->getChildSeries($categories);
        
        $categories = array_merge($categories, array($category));
        foreach ($categories as $category) {
            $parents = array();
            $ids = array();
            
            $category->getParentsSeries($parents);
            
            foreach($parents as $parent) {
                $ids[] = $parent->getId();
            }
            
            $criteriaWhere = new Criteria();
            $criteriaWhere->add(self::ID, $category->getId());
            
            $criteriaSet = new Criteria();
            
            if (count($ids) > 0) {
                $criteriaSet->add(self::PATH, implode(',', $ids));
            }
            else {
                $criteriaSet->add(self::PATH, null);
            }
            
            BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
        }
    }
    
   /**
    * Sets all categories as deleted by ids.
    * 
    * @param  array $ids
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function deleteByIds($ids)
    {
        $criteriaWhere = new Criteria();
        $criteriaWhere->add(self::ID, $ids, Criteria::IN);
        
        $criteriaSet = new Criteria();
        $criteriaSet->add(self::IS_DELETED, 1);
        
        BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
    }
    
    /**
     * Determines is parent active for each child of category and all childs
     * of his child.
     *
     * Set a field isParentActive true if category has active parent, otherwise set 0.
     * 
     * @param  Category $category category, which childs should be updated
     * @return void
     * @author Michal Gorny
     * @access public
     */
    public static function determineIsParentActive($category)
    {
        $criteriaWhere = new Criteria();
        $criteriaSet = new Criteria();
        
        $criteriaWhere->add(self::PARENT_ID, $category->getId());
        $criteriaSet->add(self::IS_PARENT_ACTIVE, $category->getIsActive() && $category->getIsParentActive());
        
        BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
        
        $childs = array();
        $childs = $category->getChild();
        
        if ($childs != null) {
            foreach($childs as $child) {
                if ($child->getHasChild() == 0) {
                    continue;
                }
                
                self::determineIsParentActive($child);
            }
        }
    }
}
