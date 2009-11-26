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
 * Subclass for representing a row from the 'basket' table.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>, Andrey Kotlyarov
 * @version    SVN: $Id: Basket.php 6174 2007-11-27 06:22:40Z fabien $
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getTotalPrice()
    {
        $price = 0;
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $price = $price + $basketProduct->getTotalPrice();
            }
        }
        
        return $price;
    }
    
   /**
    * Calculates sum of all products + delivery and payment price.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    public function getTotalPriceWithDeliveryPriceAndPaymentPrice()
    {
        $price = 0;
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $price = $price + $basketProduct->getTotalPrice();
            }
        }
        $price = $price + sfContext::getInstance()->getUser()->getAttribute('price', 0, 'order/delivery') + sfContext::getInstance()->getUser()->getAttribute('tax', 0, 'order/delivery') + sfContext::getInstance()->getUser()->getAttribute('price', 0, 'order/payment') + sfContext::getInstance()->getUser()->getAttribute('tax', 0, 'order/payment');
        return $price;
    }
    
    
    
   /**
    * Checks on exist and have enough quantity all added product to basket.
    *
    * @param  void
    * @return bool
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function checkProductsAvailability()
    {
        if ($this->hasProducts()) {
            $basketProducts = $this->getBasketProductsJoinProduct();
            
            foreach ($basketProducts as $basketProduct) {
                $product = $basketProduct->getProduct();
                $optionIds = null;
                if($basketProduct->getOptionsList() != '')
                  $optionIds = explode(',',$basketProduct->getOptionsList());
                if (!$product->getIsActive() || $product->getIsDeleted()) {
                    $this->unavailabilityProducts['deleted'] = $product->getId();
                    $basketProduct->delete();
                }
                else if($product->getProductQuantity($optionIds) < $basketProduct->getQuantity()) {
                    if(!$product->getAllowOutOfStock())
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
    * Gets array with unavailability products added to basket.
    *
    * @param  void
    * @return array
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getUnavailabilityProducts()
    {
        return $this->unavailabilityProducts;
    }
    
   /**
    * Gets all total weight of all products added to basket.
    *
    * @param  void
    * @return float
    * @author Andrey Kotlyarov
    * @access public
    */
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
    
   /**
    * Gets all total cube of all products added to basket.
    *
    * @param  void
    * @return float
    * @author Andrey Kotlyarov
    * @access public
    */
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
    
   /**
    * Gets all total quantity of all products added to basket.
    *
    * @param  void
    * @return int
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getTotalQuantity()
    {
        $quantity = 0;
        
        if ($this->hasProducts()) {
            foreach ($this->getBasketProductsJoinProduct() as $basketProduct) {
                $quantity = $quantity + $basketProduct->getQuantity();
            }
        }
        
        return $quantity;
    }
    
   /**
    * Delete all products from current basket.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function clear()
    {
        BasketProductPeer::deleteAllProductsByBasketId($this->getId());
    }
}
