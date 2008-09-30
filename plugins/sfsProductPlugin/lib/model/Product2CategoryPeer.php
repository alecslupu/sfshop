<?php

/**
 * Subclass for performing query and update operations on the 'products2categories' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class Product2CategoryPeer extends BaseProduct2CategoryPeer
{
   /**
    * Gets all products ids by categories ids.
    * 
    * @param  array $categoriesIds
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getProductsIdsByCategoriesIds($categoriesIds)
    {
        $criteria = new Criteria();
        $criteria->add(self::CATEGORY_ID, $categoriesIds, Criteria::IN);
        $products2categories = self::doSelect($criteria);
        
        $productIds = array();
        
        if (count($products2categories) > 0) {
            foreach ($products2categories as $product2category) {
                $productIds[] = $product2category->getProductId();
            }
        }
        
        return $productIds;
    }
}
