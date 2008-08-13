<?php

/**
 * order actions.
 *
 * @package    sfShop
 * @subpackage order
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class orderActions extends sfActions
{
   /**
    * Order details. Creates new order item and order products if member confirmed order.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeCheckoutConfirmation()
    {
        $sfUser = $this->getUser();
        
        $this->deliveryAddressArray = $sfUser->getAttribute('address', null, 'order/delivery');
        $this->basket = $sfUser->getBasket();
        
        if (!$this->basket ->hasProducts() || $this->deliveryAddressArray == null) {
            $this->redirect('@basket_list');
        }
        
        if ($this->getRequest()->isMethod('post')) {
            
            if (!$this->basket->hasProducts() || !$this->basket->checkProductsAvailability()) {
                $sfUser->getAttributeHolder()->add($this->basket->getUnavailabilityProducts(), 'products/unavailability');
                $this->redirect('@basket_list');
            }
            else {
                $addressInfo = $sfUser->getAttribute('address', null, 'order/delivery');
                $address = new AddressBook();
                $address->fromArray($addressInfo, BasePeer::TYPE_FIELDNAME);
                
                $member = $sfUser->getUser();
                
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
                
                $order->setUuid(md5(time() + rand()));
                $order->setStatusId(OrderStatusPeer::STATUS_PENDING);
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
                
                $this->basket->delete();
                $this->redirect('@payment_paypal?order_item_id=' . $order->getId());
            }
        }
    }
    
   /**
    * Finish checkout, sets status pending for order.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeCheckoutFinished()
    {
        sfLoader::loadHelpers('sfsShipping');
        
        $uuid = $this->getRequestParameter('uuid');
        $this->order = OrderItemPeer::retrieveByUuid($uuid);
        $this->forward404Unless($this->order);
        
        $this->deliveryRate = odfl_rate($this->order);
        $this->order->setDeliveryCost($this->deliveryRate['cost']);
        $this->order->setDeliveryDescription($this->deliveryRate['description']);
        
        
        $this->order->setStatusId(OrderStatusPeer::STATUS_PROCESSING);
        $this->order->save();
    }
    
   /**
    * Checkout is suspend.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
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
    * @author Dmitry Nesteruk
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
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDetails()
    {
        $this->order = OrderItemPeer::retrieveById($this->getRequestParameter('id'));
        $this->forward404Unless($this->order);
    }
}
