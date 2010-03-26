<?php

/**
 * Subclass for performing query and update operations on the 'option_product' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionProductPeer extends BaseOptionProductPeer
{
    const PRICE_TYPE_ADD = 1;
    const PRICE_TYPE_REPLACE = 2;
    const PRICE_TYPE_MINUS = 3;
    
    
   /**
    * Delete all option product by $productId.
    * 
    * @param  int $productId
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function deleteByProductId($productId)
    {
        $criteria = new Criteria();
        $criteria->add(self::PRODUCT_ID, $productId);
        
        BasePeer::doDelete($criteria, Propel::getConnection(self::DATABASE_NAME));
    }
}
