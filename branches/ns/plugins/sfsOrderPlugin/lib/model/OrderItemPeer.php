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
    * Generate new uuid
    *
    * @param  void
    * @return string uuid
    * @author Andreas Nyholm
    * @access public
    */
    public static function generateUuid() 
    {
        if($method = sfConfig::get('app_order_uuid_method', false)) {
            $methodAsStr = is_array($method) ? $method[0].'::'.$method[1] : $method;
            if (!is_callable($methodAsStr))
            {
              throw new sfException(sprintf('The method "%s" is not callable.', $methodAsStr));
            }
            return call_user_func_array($methodAsStr,array());
        }        
        return md5(time() + rand());   
    }
}
