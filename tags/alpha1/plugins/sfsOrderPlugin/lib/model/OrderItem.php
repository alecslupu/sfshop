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
        
        foreach ($this->getOrderProductsJoinProduct() as $orderProduct) {
            $price = $price + $orderProduct->getPrice() * $orderProduct->getQuantity();
        }
        
        return $price;
    }
    
   /**
    * Calculates sum of all products and delivery price.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getTotalPriceWithDeliveryPrice()
    {
        return $this->getTotalPrice() + $this->getDeliveryPrice();
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
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getDeliveryAddress()
    {
        return array(
            'first_name'  => $this->getDeliveryFirstName(),
            'last_name'   => $this->getDeliveryLastName(),
            'country_id'  => $this->getDeliveryCountryId(),
            'state_id'    => $this->getDeliveryStateId(),
            'state_title' => $this->getDeliveryStateTitle(),
            'city'        => $this->getDeliveryCity(),
            'street'      => $this->getDeliveryStreet(),
            'postcode'    => $this->getDeliveryPostcode()
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
