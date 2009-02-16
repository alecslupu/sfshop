<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Subclass for performing query and update operations on the 'orders_status' table.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */ 
class OrderStatusPeer extends BaseOrderStatusPeer
{
    const STATUS_PENDING    = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_DELIVERYNG = 3;
    const STATUS_DELIVERED  = 4;
    const STATUS_CANCELED   = 5;
    
   /**
    * Gets hash of all items.
    *
    * @param  void
    * @return array
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function getHashAll()
    {
        $statuses = self::getAll(new Criteria(), true);
        
        $hash = array();
        
        if (count($statuses) > 0) {
            foreach ($statuses as $status) {
                $hash[$status->getId()] = $status->getTitle();
            }
        }
        
        return $hash;
    }
}
