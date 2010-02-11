<?php

/**
 * Subclass for representing a row from the 'orders_status' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderStatus extends BaseOrderStatus
{
   /**
    * Gets string value of orderStatus object.
    *
    * @param  void
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public function __toString()
    {
        return $this->getTitle();
    }
}
