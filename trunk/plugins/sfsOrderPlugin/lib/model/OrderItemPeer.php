<?php

/**
 * Subclass for performing query and update operations on the 'order_item' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderItemPeer extends BaseOrderItemPeer
{
   /**
    * Gets order object by uuid
    *
    * @param  string $uuid
    * @return mixed if order exist returns object, otherwise null
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByUuid($uuid)
    {
        $criteria = new Criteria();
        $criteria->add(self::UUID, $uuid, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Gets order object by id
    *
    * @param  int $id
    * @return mixed if order exist returns object, otherwise null
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById($id)
    {
        $criteria = new Criteria();
        $criteria->add(self::ID, $id, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
    
    
}
