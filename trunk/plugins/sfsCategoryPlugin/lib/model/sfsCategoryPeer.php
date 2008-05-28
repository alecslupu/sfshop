<?php

/**
 * Subclass for performing query and update operations on the 'categories' table.
 *
 * 
 *
 * @package plugins.sfsCategoryPlugin.lib.model
 */ 
class sfsCategoryPeer extends BasesfsCategoryPeer
{
    /**
    * Gets all avaliable categories with parent_id 0.
    *
    * @param  void
    * @return array with objects, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getFirstLevel()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, 1);
        $criteria->add(self::PARENT_ID, 0);
        $criteria->addAscendingOrderByColumn(sfsCategoryI18nPeer::TITLE);
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
        /*
        $cache = new sfArrayCache(sfConfig::get('app_categories_cache_dir', 'categories'));
        
        $ids = $cache->get('child_categories', $categoryId);
        
        if ($ids === null) {
            */
            $categories = self::getAllChild($categoryId);
            $ids = array();
            
            foreach ($categories as $category) {
                $ids[] = $category->getId();
            }
            /*
            $cache->setLifeTime(sfConfig::get('app_categories_cache_life_time', 84600));
            $cache->set('child_categories', $categoryId, $ids);
        }
        */
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
}
