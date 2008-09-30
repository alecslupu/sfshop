<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
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
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class orderActions extends sfActions
{
   /**
    * Order details. Creates new order item and order products if member confirmed order.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckoutConfirmation($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        $sfUser = $this->getUser();
        
        $this->deliveryAddressArray = $sfUser->getAttribute('address', null, 'order/delivery');
        $this->basket = $sfUser->getBasket();
        
        if (!$this->basket ->hasProducts() || $this->deliveryAddressArray == null) {
            $this->redirect('@basket_list');
        }
        
        $this->form = new sfsOrderCommentForm();
        
        if ($request->isMethod('post')) {
            
            if (!$this->basket->hasProducts() || !$this->basket->checkProductsAvailability()) {
                $sfUser->getAttributeHolder()->add($this->basket->getUnavailabilityProducts(), 'products/unavailability');
                $this->redirect('@basket_list');
            }
            else {
                
                $data = $this->getRequestParameter('data');
                
                $this->form->bind($data);
                
                $member = $sfUser->getUser();
                
                if ($member->getPhone() == '' && $member->getMobile() == '') {
                    $this->errorContact = __('Please, input your phone number');
                }
                
                if ($this->form->isValid() && !isset($this->errorContact)) {
                    
                    $address = new AddressBook();
                    $address->fromArray($this->deliveryAddressArray, BasePeer::TYPE_FIELDNAME);
                    
                    $order = new OrderItem();
                    
                    $order->setMemberId($member->getId());
                    $order->setMemberFirstName($member->getFirstName());
                    $order->setMemberLastName($member->getLastName());
                    
                    $order->setBillingFirstName($address->getFirstName());
                    $order->setBillingLastName($address->getLastName());
                    $order->setBillingCountryId($address->getCountryId());
                    $order->setBillingStateId($address->getStateId());
                    $order->setBillingStateTitle($address->getStateTitle());
                    $order->setBillingCity($address->getCity());
                    $order->setBillingStreet($address->getStreet());
                    $order->setBillingPostcode($address->getPostcode());
                    
                    $order->setDeliveryFirstName($address->getFirstName());
                    $order->setDeliveryLastName($address->getLastName());
                    $order->setDeliveryCountryId($address->getCountryId());
                    $order->setDeliveryStateId($address->getStateId());
                    $order->setDeliveryStateTitle($address->getStateTitle());
                    $order->setDeliveryCity($address->getCity());
                    $order->setDeliveryStreet($address->getStreet());
                    $order->setDeliveryPostcode($address->getPostcode());
                    
                    $order->setDeliveryPrice($sfUser->getAttribute('price', null, 'order/delivery'));
                    $order->setUuid(md5(time() + rand()));
                    $order->setStatusId(OrderStatusPeer::STATUS_PENDING);
                    
                    $methodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
                    $methodTitle = $sfUser->getAttribute('method_title', null, 'order/delivery');
                    list($serviceId, $methodId) = explode('_', $methodId);
                    $order->setDeliveryId($serviceId);
                    $order->setDeliveryMethodTitle($methodTitle);
                    
                    $order->setComment($data['comment']);
                    $order->save();
                    
                    $basketProducts = $this->basket->getBasketProductsJoinProduct();
                    
                    foreach ($basketProducts as $basketProduct) {
                        $orderProduct = new OrderProduct();
                        $orderProduct->setOrderItemId($order->getId());
                        $orderProduct->setProductId($basketProduct->getProductId());
                        $orderProduct->setPrice($basketProduct->getProduct()->getPrice());
                        $orderProduct->setQuantity($basketProduct->getQuantity());
                        $orderProduct->save();
                        
                        if ($basketProduct->getProduct()->getHasOptions()) {
                            
                            $productOptions = $basketProduct->getBasketProduct2OptionProducts();
                            
                            foreach ($productOptions as $productOption) {
                                $orderProduct2OptionProduct = new OrderProduct2OptionProduct();
                                $orderProduct2OptionProduct->setOrderProductId($orderProduct->getId());
                                $orderProduct2OptionProduct->setOptionProductId($productOption->getOptionProductId());
                                $orderProduct2OptionProduct->save();
                            }
                        }
                    }
                    
                    $orderProducts = $order->getOrderProductsJoinProduct();
                    
                    foreach ($orderProducts as $orderProduct) {
                        $product = $orderProduct->getProduct();
                        $product->setQuantity($product->getQuantity() - $orderProduct->getQuantity());
                        
                        if ($product->getQuantity() == 0) {
                            $product->setIsActive(0);
                        }
                        
                        $product->save();
                    }
                    
                    $this->basket->clear();
                    
                    $methodId = $sfUser->getAttribute('method_id', null, 'order/payment');
                    $paymentMethod = PaymentPeer::retrieveById($methodId);
                    
                    $this->redirect($paymentMethod->getChargeRoute() . '?order_item_id=' . $order->getId());
                }
            }
        }
    }
    
   /**
    * Finish checkout page.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckoutFinished($request)
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Checkout is suspend.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckoutSuspend()
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Members orders.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeMyList()
    {
        $this->pager = new sfPropelPager('OrderItem', 10);
        $criteria = new Criteria();
        $criteria->add(OrderItemPeer::MEMBER_ID, $this->getUser()->getUserId());
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();
    }
    
   /**
    * Delete order if order has status pending.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $order = OrderItemPeer::retrieveById($this->getRequestParameter('id'));
            $this->forward404Unless($order);
            
            if ($order->getStatusId() == OrderStatusPeer::STATUS_PENDING) {
                $order->delete();
            }
        }
        
        $this->redirect('@order_myList');
    }
    
   /**
    * Order detail.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeDetails()
    {
        $this->order = OrderItemPeer::retrieveById($this->getRequestParameter('id'));
        $this->forward404Unless($this->order);
        $this->deliveryAddress = $this->order->getDeliveryAddress();
    }
}
