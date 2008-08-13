<?php

/**
 * Subclass for representing a row from the 'basket_product' table.
 *
 * 
 *
 * @package plugins.sfsBasketPlugin.lib.model
 */ 
class BasketProduct extends BaseBasketProduct
{
   /**
    * Calculates product price with options.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getPrice()
    {
        $product = $this->getProduct();
        $price = $product->getPrice();
        
        if ($product->getHasOptions()) {
            $basketOptions = $this->getBasketProduct2OptionProducts();
            
            $optionProducts = array();
            
            foreach ($basketOptions as $basketOption) {
                $optionProduct = $basketOption->getOptionProduct();
                $optionProducts[] = $optionProduct;
                
                if ($optionProduct->getPriceType() == OptionProductPeer::PRICE_TYPE_REPLACE) {
                    $price = $optionProduct->getPrice();
                }
            }
            
            foreach ($optionProducts as $optionProduct) {
                if ($optionProduct->getPriceType() == OptionProductPeer::PRICE_TYPE_ADD) {
                    $price += $optionProduct->getPrice();
                }
            }
        }
        
        return $price;
    }
    
   /**
    * Calculates total price for this product.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getTotalPrice()
    {
        return $this->getQuantity() * $this->getPrice();
    }
}
