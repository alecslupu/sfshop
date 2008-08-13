<?php

/**
 * Subclass for performing query and update operations on the 'categories' table.
 *
 * 
 *
 * @package plugins.sfsCategoryPlugin.lib.model
 */ 
class CategoryPeer extends BaseCategoryPeer
{
    
   /**
    * Gets all avaliable categories with parent_id 0.
    *
    * @param  void
    * @return array with objects, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getFirstLevel($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::PARENT_ID, null, Criteria::ISNULL);
        $criteria->addAscendingOrderByColumn(CategoryI18nPeer::TITLE);
        return self::doSelectWithI18n($criteria);
    }
    
   /**
    * Gets array with all child's ids for category.
    * 
    * Returns ids of child categories for current category and all ids of child categories for his child.
    * 
    * @param  $categoryId
    * @return array with ids
    * @author Dmitry Nesteruk
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
    * @author Dmitry Nesteruk
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
    * Determines for each category is has child.
    * 
    * Set true to field hasChild if category has child, otherwise set 0.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
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
    * Determines for each category path.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
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
    * Sets all categories is deleted by ids.
    * 
    * @param  array $ids
    * @return void
    * @author Dmitry Nesteruk
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
    * Get avaliable category with details by $id.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById($id, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID, $id);
        return self::doSelectOne($criteria);
    }
}
