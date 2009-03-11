<?php

/**
 * Subclass for representing a row from the 'order_item' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderItem extends BaseOrderItem
{
   /**
    * Calculates sum of all products.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getTotalPrice()
    {
        $price = 0;
        
        foreach ($this->getOrderProducts() as $orderProduct) {
            $price = $price + $orderProduct->getTotalPrice();
        }
        
        return $price;
    }
    
   /**
    * Calculates sum (gross) of all products and delivery price and payment price.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk, Andreas Nyholm
    * @access public
    */
    public function getTotalPriceWithDeliveryPriceAndPaymentPrice()
    {
        $price = 0;
        
        foreach ($this->getOrderProducts() as $orderProduct) {
            $price = $price + $orderProduct->getTotalGrossPrice();
        }
        $price = $price + $this->getDeliveryPrice() + $this->getDeliveryTax() + $this->getPaymentPrice() + $this->getPaymentTax();
        
        return $price;
    }
    
   /**
    * Gets status for this order, returns string value.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getStatus()
    {
        return OrderStatusPeer::retrieveById($this->getStatusId(), null, true)->getTitle();
    }
    
   /**
    * Gets count of products by order item id.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getProductsCount()
    {
        return OrderProductPeer::retrieveProductsCountByOrderItemId($this->getId());
    }
    
   /**
    * Get full member name for delivering.
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getDeliveryFullName()
    {
        return $this->getDeliveryFirstName() . ' ' . $this->getDeliveryLastName();
    }
    
   /**
    * Get full member name.
    *
    * @param  void
    * @return string $value
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getMemberFullName()
    {
        return $this->getMemberFirstName() . ' ' . $this->getMemberLastName();
    }
    
    
   /**
    * Get array with details for delivery address.
    *
    * @param  void
    * @return array
    * @author Dmitry Nesteruk, Andreas Nyholm
    * @access public
    */
    public function getDeliveryAddress()
    {   
        if($this->getDeliveryStateId())
            $state = $this->getStateRelatedByDeliveryStateId();
        else
            $state = $this->getDeliveryStateTitle();
        return array(
            'first_name'  => $this->getDeliveryFirstName(),
            'last_name'   => $this->getDeliveryLastName(),
            'company'     => $this->getDeliveryCompany(),
            'country_id'  => $this->getDeliveryCountryId(),
            'country'     => $this->getCountryRelatedByDeliveryCountryId(),
            'state'       => $state,
            'state_id'    => $this->getDeliveryStateId(),
            'state_title' => $this->getDeliveryStateTitle(),
            'city'        => $this->getDeliveryCity(),
            'street'      => $this->getDeliveryStreet(),
            'postcode'    => $this->getDeliveryPostcode()
        );
    }
    
   /**
    * Get array with details for delivery service.
    *
    * @param  void
    * @return array
    * @author Andreas Nyholm
    * @access public
    */
    public function getDeliveryService() 
    {
        return array(
            'delivery_id'   => $this->getDeliveryId(),
            'price'         => $this->getDeliveryPrice(),
            'title'         => $this->getDeliveryTitle(),
            'method_title'  => $this->getDeliveryMethodTitle(),
            'tax'           => $this->getDeliveryTax(),
            'tax_type_id'   => $this->getDeliveryTaxTypeId(),
            'tax_title'     => $this->getDeliveryTaxTitle(),
            'currency_id'   => $this->getCurrencyId(),
        );
    }
    
   /**
    * Get array with details for paymeny service.
    *
    * @param  void
    * @return array
    * @author Andreas Nyholm
    * @access public
    */
    public function getPaymentService() 
    {
        return array(
            'payment_id'    => $this->getPaymentId(),
            'price'         => $this->getPaymentPrice(),
            'title'         => $this->getPaymentTitle(), 
            'tax'           => $this->getPaymentTax(),
            'tax_type_id'   => $this->getPaymentTaxTypeId(),
            'tax_title'     => $this->getPaymentTaxTitle(),
            'currency_id'   => $this->getCurrencyId(),
        );
    }
    
   /**
    * Get array with details for contact info.
    *
    * @param  void
    * @return array
    * @author Andreas Nyholm
    * @access public
    */
    public function getContactInfo() 
    {
        return array(
            'member_id'         => $this->getMemberId(),
            'first_name'        => $this->getMemberFirstName(),
            'last_name'         => $this->getMemberLastName(),
            'email'             => $this->getMemberEmail(),
            'primary_phone'     => $this->getMemberPrimaryPhone(),
            'secondary_phone'   => $this->getMemberSecondaryPhone(),
        );
    }
    
    
    public function getTotalWeight()
    {
        $weight = 0;
        
        foreach ($this->getOrderProductsJoinProduct() as $orderProduct) {
            $weight = $weight + $orderProduct->getProduct()->getWeight() * $orderProduct->getQuantity();
        }
        
        return $weight;
    }
    public function getTotalCube()
    {
        $cube = 0;
        
        foreach ($this->getOrderProductsJoinProduct() as $orderProduct) {
            $cube = $cube + $orderProduct->getProduct()->getCube() * $orderProduct->getQuantity();
        }
        
        return $cube;
    }
    
    
}
