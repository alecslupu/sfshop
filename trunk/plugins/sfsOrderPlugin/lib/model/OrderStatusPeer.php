<?php

/**
 * Subclass for performing query and update operations on the 'orders_status' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderStatusPeer extends BaseOrderStatusPeer
{
    const STATUS_PENDING    = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_DELIVERYNG = 3;
    const STATUS_DELIVERED  = 4;
    const STATUS_CANCELED   = 5;
    
   /**
    * Gets status order object by Id with I18n.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByIdWithI18n($id)
    {
        $criteria = new Criteria();
        $criteria->add(self::ID, $id, Criteria::EQUAL);
        $criteria->setLimit(1);
        list($status) = self::doSelectWithTranslation($criteria);
        return $status;
    }
    
    public static function getAllWithI18n($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        return self::doSelectWithTranslation($criteria);
    }
}
