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
}
