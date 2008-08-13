<?php

/**
 * Subclass for representing a row from the 'basket' table.
 *
 * 
 *
 * @package plugins.sfsBasketPlugin.lib.model
 */ 
class Basket extends BaseBasket
{
    protected $unavailabilityProducts = array();
    protected $hasProducts = null;
    
    public function hasProducts()
    {
        if ($this->hasProducts == null) {
            $c = new Criteria();
            $c->addAnd(BasketProductPeer::BASKET_ID, $this->getId(), Criteria::EQUAL);
            $this->hasProducts = BasketProductPeer::doCount($c) > 0 ? true : false;
        }
        
        return $this->hasProducts;
    }
    
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
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $price = $price + $basketProduct->getPrice() * $basketProduct->getQuantity();
            }
        }
        
        return $price;
    }
    
   /**
    * Checks on exist and have enough quantity all added product to basket.
    *
    * @param  void
    * @return bool
    * @author Dmitry Nesteruk
    * @access public
    */
    public function checkProductsAvailability()
    {
        if ($this->hasProducts()) {
            $basketProducts = $this->getBasketProductsJoinProduct();
            
            foreach ($basketProducts as $basketProduct) {
                $product = $basketProduct->getProduct();
                
                if (!$product->getIsActive() || $product->getIsDeleted()) {
                    $this->unavailabilityProducts['deleted'] = $product->getId();
                    $basketProduct->delete();
                }
                else if($product->getQuantity() < $basketProduct->getQuantity()) {
                    $this->unavailabilityProducts['insufficiently'] = $product->getId();
                }
            }
        }
        
        if (!empty($this->unavailabilityProducts)) {
            return false;
        }
        else {
            return true;
        }
    }
    
   /**
    * Gets array with unavailability products which was added to basket.
    *
    * @param  void
    * @return bool
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getUnavailabilityProducts()
    {
        return $this->unavailabilityProducts;
    }
    
    
    
    
    
    public function getTotalWeight()
    {
        $weight = 0;
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $weight = $weight + $basketProduct->getProduct()->getWeight() * $basketProduct->getQuantity();
            }
        }
        
        return $weight;
    }
    public function getTotalCube()
    {
        $cube = 0;
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $cube = $cube + $basketProduct->getProduct()->getCube() * $basketProduct->getQuantity();
            }
        }
        
        return $cube;
    }
    
}
