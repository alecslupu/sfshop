<?php

/**
 * Subclass for performing query and update operations on the 'order_product' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderProductPeer extends BaseOrderProductPeer
{
   /**
    * Gets count by products for order item id.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveProductsCountByOrderItemId($orderItemId)
    {
        $criteria = new Criteria();
        $criteria->add(self::ORDER_ITEM_ID, $orderItemId, Criteria::EQUAL);
        return self::doCount($criteria);
    }
}
