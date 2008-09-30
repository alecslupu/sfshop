<?php

/**
 * Subclass for representing a row from the 'order_product' table.
 *
 * 
 *
 * @package plugins.sfsOrderPlugin.lib.model
 */ 
class OrderProduct extends BaseOrderProduct
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
            $orderOptions = $this->getOrderProduct2OptionProducts();
            
            $optionProducts = array();
            
            foreach ($orderOptions as $orderOption) {
                $optionProduct = $orderOption->getOptionProduct();
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
