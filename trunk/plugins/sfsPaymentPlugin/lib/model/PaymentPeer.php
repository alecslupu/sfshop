<?php

/**
 * Subclass for performing query and update operations on the 'payment' table.
 *
 * 
 *
 * @package plugins.sfsPaymentPlugin.lib.model
 */ 
class PaymentPeer extends BasePaymentPeer
{
   /**
    * Gets payment service object by name.
    *
    * @param  string $name
    * @return mixed if service exist returns object, otherwise null.
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function retrieveByName($name)
    {
        $criteria = new Criteria();
        $criteria->add(self::NAME, $name);
        return self::doSelectOne($criteria);
    }
}
