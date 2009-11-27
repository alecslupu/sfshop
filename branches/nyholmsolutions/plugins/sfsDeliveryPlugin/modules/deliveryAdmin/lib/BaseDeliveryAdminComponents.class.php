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
 * Delivery components.
 *
 * @package    plugins.sfsDeliveryPlugin
 * @subpackage modules.delivery
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseDeliveryAdminComponents extends sfComponents
{
   /**
    * Delivery method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDeliveryInfo()
    {
        $this->deliveryService = DeliveryPeer::retrieveById($this->id, new Criteria(), true);
    }
}
