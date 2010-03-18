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
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseOrderActions extends sfActions
{
   /**
    * Order details. Creates new order item and order products if member confirmed order.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCheckoutConfirmation($request)
    {
        $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
        
        $sfUser = $this->getUser();
        
        $this->basket = $sfUser->getBasket();
        
        if (!$this->basket->hasProducts()) {
            $this->redirect('@basket_list');
        }
        
        $this->form = new sfsOrderCommentForm();
        
        if ($request->isMethod('post')) {
            
            if (!$this->basket->hasProducts() || !$this->basket->checkProductsAvailability()) {
                $sfUser->getAttributeHolder()->add($this->basket->getUnavailabilityProducts(), 'products/unavailability');
                $this->redirect('@basket_list');
            }
            else {
                
                $data = $request->getParameter('data');
                
                $this->form->bind($data);
                
                $member = $sfUser->getUser();
                
                if ($member->getPrimaryPhone() == '') {
                    $this->errorContact = __('Please, input primary phone number');
                }
                
                if ($this->form->isValid() && !isset($this->errorContact)) {
                    
                    $addressId = $this->getUser()->getAttribute('address_id', null, 'order/billing');
                    $billingAddress = AddressBookPeer::retrieveById($addressId);
                    
                    $addressId = $this->getUser()->getAttribute('address_id', null, 'order/delivery');
                    $deliveryAddress = AddressBookPeer::retrieveById($addressId);
                    
                    $order = new OrderItem();
                    
                    $order->setMemberId($member->getId());
                    $order->setMemberFirstName($member->getFirstName());
                    $order->setMemberLastName($member->getLastName());
                    $order->setMemberEmail($member->getEmail());
                    $order->setMemberPrimaryPhone($member->getPrimaryPhone()); // $data['primary_phone'] ??
                    $order->setMemberSecondaryPhone($member->getSecondaryPhone()); // $data['secondary_phone'] ??
                    
                    $order->setBillingFirstName($billingAddress->getFirstName());
                    $order->setBillingLastName($billingAddress->getLastName());
                    $order->setBillingCompany($billingAddress->getCompany());
                    $order->setBillingCountryId($billingAddress->getCountryId());
                    $order->setBillingStateId($billingAddress->getStateId());
                    $order->setBillingStateTitle($billingAddress->getStateTitle());
                    $order->setBillingCity($billingAddress->getCity());
                    $order->setBillingStreet($billingAddress->getStreet());
                    $order->setBillingPostcode($billingAddress->getPostcode());
                    
                    $order->setPaymentPrice($sfUser->getAttribute('price', null, 'order/payment'));
                    $order->setPaymentTaxTypeId($sfUser->getAttribute('tax_type_id', null, 'order/payment'));
                    $order->setPaymentTax($sfUser->getAttribute('tax', null, 'order/payment'));
                    $order->setPaymentTaxTitle($sfUser->getAttribute('tax_title', null, 'order/payment'));
                    $methodId = $sfUser->getAttribute('method_id', null, 'order/payment');
//                    $methodTitle = $sfUser->getAttribute('method_title', null, 'order/payment');
                    $order->setPaymentId($methodId);
                    $order->setPaymentTitle(PaymentPeer::retrieveById($methodId)->getTitle()); // $methodTitle
                    
      
                    $order->setDeliveryFirstName($deliveryAddress->getFirstName());
                    $order->setDeliveryLastName($deliveryAddress->getLastName());
                    $order->setDeliveryCompany($deliveryAddress->getCompany());
                    $order->setDeliveryCountryId($deliveryAddress->getCountryId());
                    $order->setDeliveryStateId($deliveryAddress->getStateId());
                    $order->setDeliveryStateTitle($deliveryAddress->getStateTitle());
                    $order->setDeliveryCity($deliveryAddress->getCity());
                    $order->setDeliveryStreet($deliveryAddress->getStreet());
                    $order->setDeliveryPostcode($deliveryAddress->getPostcode());
                    $order->setDeliveryPrice($sfUser->getAttribute('price', null, 'order/delivery'));
                    $order->setDeliveryTaxTypeId($sfUser->getAttribute('tax_type_id', null, 'order/delivery'));
                    $order->setDeliveryTax($sfUser->getAttribute('tax', null, 'order/delivery'));
                    $order->setDeliveryTaxTitle($sfUser->getAttribute('tax_title', null, 'order/delivery'));

                    $order->setUuid(OrderItemPeer::generateUuid());
                    $order->setStatusId(OrderStatusPeer::STATUS_PENDING);
                    
                    $methodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
                    $methodTitle = $sfUser->getAttribute('method_title', null, 'order/delivery');
                    list($serviceId, $methodId) = explode('_', $methodId);
                    $order->setDeliveryId($serviceId);
                    $order->setDeliveryMethodTitle($methodTitle);
                    $order->setDeliveryTitle(DeliveryPeer::retrieveById($serviceId)->getTitle());
                    
                    $order->setCurrencyId($this->basket->getCurrencyId());
                    
                    $order->setComment($data['comment']);
                    $order->save();
                    
                    $basketProducts = $this->basket->getBasketProductsJoinProduct();
                    
                    foreach ($basketProducts as $basketProduct) {
                        $orderProduct = new OrderProduct();
                        $orderProduct->setOrderItemId($order->getId());
                        $orderProduct->setProductId($basketProduct->getProductId());
                        $orderProduct->setPrice($basketProduct->getNetPrice());
                        $orderProduct->setQuantity($basketProduct->getQuantity());
                        $orderProduct->setTitle($basketProduct->getProduct()->getTitle());
                        $orderProduct->setTaxTypeId($basketProduct->getProduct()->getTaxTypeId());
                        $orderProduct->setTax($basketProduct->getGrossPrice() - $basketProduct->getNetPrice());
                        if($basketProduct->getProduct()->getTaxType())
                            $orderProduct->setTaxTitle($basketProduct->getProduct()->getTaxType()->getTitle());
                        $orderProduct->setWeight($basketProduct->getProduct()->getWeight());
                        $orderProduct->setCube($basketProduct->getProduct()->getCube());
                        $orderProduct->save();
                        
                        if ($basketProduct->getProduct()->getHasOptions()) {
                            
                            $productOptions = $basketProduct->getBasketProduct2OptionProducts();
                            
                            foreach ($productOptions as $productOption) {
                                $orderProduct2OptionProduct = new OrderProduct2OptionProduct();
                                $orderProduct2OptionProduct->setOrderProductId($orderProduct->getId());
                                $orderProduct2OptionProduct->setOptionProductId($productOption->getOptionProductId());
                                $orderProduct2OptionProduct->setTitle($productOption->getOptionProduct()->getOptionValue()->getTitle());
                                $orderProduct2OptionProduct->save();
                            }
                        }
                    }
                    
                    $orderProducts = $order->getOrderProductsJoinProduct();
                    
                    foreach ($orderProducts as $orderProduct) {
                        $product = $orderProduct->getProduct();
                        if($product->getHasOptions() && $product->getQuantity() === null) {
                          foreach($orderProduct->getOrderProduct2OptionProducts() as $option){
                              $prod_option = $option->getOptionProduct();
                              if($prod_option) {
                                  if($prod_option->getQuantity() !== null)
                                    $prod_option->setQuantity($prod_option->getQuantity() - $orderProduct->getQuantity());
                              }
                          }
                        }
                        else
                          $product->setQuantity($product->getQuantity() - $orderProduct->getQuantity());
                        
                        if ($product->getProductQuantity() <= 0 &&  !$product->getAllowOutOfStock()) {
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $criteria = new Criteria();
            $criteria->add(OrderItemPeer::MEMBER_ID, $this->getUser()->getUserId());
            $order = OrderItemPeer::retrieveById($this->getRequestParameter('id'),$criteria);
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDetails()
    {
        $c = new Criteria();
        $c->add(OrderItemPeer::MEMBER_ID, $this->getUser()->getUserId());
        $this->order = OrderItemPeer::retrieveById($this->getRequestParameter('id'),$c);
        $this->forward404Unless($this->order);
        $this->deliveryAddress = $this->order->getDeliveryAddress();
        $this->deliveryService = $this->order->getDeliveryService();
        $this->paymentService = $this->order->getPaymentService();
        $this->contactInfo = $this->order->getContactInfo();
    }
}
