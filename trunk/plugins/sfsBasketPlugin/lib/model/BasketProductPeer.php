<?php

/**
 * Subclass for performing query and update operations on the 'basket_product' table.
 *
 * 
 *
 * @package plugins.sfsBasketPlugin.lib.model
 */ 
class BasketProductPeer extends BaseBasketProductPeer
{
   /**
    * Gets product added to basket by basket id, product id and options list.
    *
    * @param  int $basketId
    * @param  int $productId
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByBasketIdAndProductId($basketId, $productId, $optionsList = null)
    {
        $criteria = new Criteria();
        $criteria->add(self::BASKET_ID, $basketId);
        $criteria->add(self::PRODUCT_ID, $productId);
        
        if ($optionsList !== null) {
            $criteria->add(self::OPTIONS_LIST, $optionsList);
        }
        
        return self::doSelectOne($criteria);
    }
    
   /**
    * Gets quantity sum of product.
    *
    * @param  int $productId
    * @return int
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveQuantityByProductId($productId)
    {
        $criteria =new Criteria();
        $criteria->addSelectColumn('SUM(' . self::QUANTITY . ') as sum');
        $criteria->addSelectColumn(self::QUANTITY);
        
        $criteria->addGroupByColumn(self::PRODUCT_ID);
        $criteria2 = $criteria->getNewCriterion(self::PRODUCT_ID, $productId);
        $criteria->addHaving($criteria2);
        $rs = self::doSelectRS($criteria);
        
        $sum = 0;
        
        while ($rs->next()){
            $sum = $rs->getString(1);
        }
        
        return $sum;
    }
}
