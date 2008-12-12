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
 * Subclass for representing a row from the 'basket_product' table.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>, Andrey Kotlyarov
 * @version    SVN: $Id: BasketProduct.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class BasketProduct extends BaseBasketProduct
{
   /**
    * Calculates product price based on product price and price of product options.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getTotalPrice()
    {
        return $this->getQuantity() * $this->getPrice();
    }
    
    
   /**
    * Calculates total weight for this product.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getTotalWeight()
    {
        return $this->getQuantity() * $this->getProduct()->getWeight();
    }
}
