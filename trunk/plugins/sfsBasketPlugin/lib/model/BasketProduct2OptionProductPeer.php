<?php

/**
 * Subclass for performing query and update operations on the 'basket_product2option_product' table.
 *
 * 
 *
 * @package plugins.sfsBasketPlugin.lib.model
 */ 
class BasketProduct2OptionProductPeer extends BaseBasketProduct2OptionProductPeer
{
   /**
    * Checks added option by basket_product_id, option_product_id.
    *
    * @param  int $basketProductId
    * @param  int $optionProductId
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function hasOption($basketProductId, $optionProductId)
    {
        $criteria = new Criteria();
        $criteria->add(self::BASKET_PRODUCT_ID, $basketProductId);
        $criteria->add(self::OPTION_PRODUCT_ID, $optionProductId);
        return (self::doCount($criteria) > 0);
    }
}
