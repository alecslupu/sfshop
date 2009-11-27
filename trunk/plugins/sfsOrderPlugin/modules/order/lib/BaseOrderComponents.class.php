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
 * Order actions.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage modules.order
 * @author     Andreas Nyholm
 * @version    SVN: $Id: BaseOrderActions.class.php 515 2009-03-16 01:27:14Z nyholmsolutions $
 */
class BaseOrderComponents extends sfComponents
{
    /**
    * Order detail.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDetails()
    {
        $c = new Criteria();
        $c->add(OrderItemPeer::MEMBER_ID, $this->getUser()->getUserId());
        $this->order = OrderItemPeer::retrieveById($this->order_id,$c);
        if(!$this->order)
          return sfView::NONE;
        $this->deliveryAddress = $this->order->getDeliveryAddress();
        $this->deliveryService = $this->order->getDeliveryService();
        $this->paymentService = $this->order->getPaymentService();
        $this->contactInfo = $this->order->getContactInfo();
//        $this->setTemplate('_detailsSuccess');
    }
}
