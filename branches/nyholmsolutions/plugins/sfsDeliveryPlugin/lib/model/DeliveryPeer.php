<?php

/**
 * Subclass for performing query and update operations on the 'delivery' table.
 *
 * 
 *
 * @package plugins.sfsDeliveryPlugin.lib.model
 */ 
class DeliveryPeer extends BaseDeliveryPeer
{
   /**
    * Gets hash of all delivery methods in array.
    *
    * @param  object $criteria
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getHashAll($criteria)
    {
        $methods = self::getAll($criteria, true);
        
        $hash = array();
        
        if (count($methods) > 0) {
            foreach ($methods as $method) {
                $hash[$method->getId()] = $method->getTitle();
            }
        }
        
        return $hash;
    }
}
