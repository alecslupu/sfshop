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
    * Gets product price based on product price and price of product options.
    * Taxes are include if app_tax_display_prices_with_tax = true
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getProductPrice()
    {
        return $this->getPrice(!sfConfig::get('app_tax_display_prices_with_tax', false));
    }

   /**
    * Gets gross price based on product price and price of product options.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getGrossPrice()
    {
        return $this->getPrice(false);
    }
    
   /**
    * Gets net price based on product price and price of product options.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getNetPrice()
    {
        return $this->getPrice(true);
    }
    
    /**
    * Calculates price based on product price and price of product options.
    *
    * @param  $net = true
    * @return string
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function getPrice($net = true)
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
                    $price = $optionProduct->getNetPrice(); //Taxes added later
                }
            }
            
            foreach ($optionProducts as $optionProduct) {
                if ($optionProduct->getPriceType() == OptionProductPeer::PRICE_TYPE_ADD) {
                    $price += $optionProduct->getNetPrice(); //Taxes added later
                }
            }
        }
        
        if($net)
            return $price;
            
        return $product->calculateGrossPrice($price);
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
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getProductPrice(),null, true);
//          return $this->getQuantity() * format_currency($this->getNetPrice(),null, true);
    }
    
   /**
    * Calculates total net price for this product.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    public function getTotalNetPrice()
    {
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getNetPrice(),null, true);
    }
    
   /**
    * Calculates total gross price for this product.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    public function getTotalGrossPrice()
    {
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getGrossPrice(),null, true);
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

   /**
    * Get title for product
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getTitle()
    {
        return $this->getProduct()->getTitle();
    }    

   /**
    * Get tax type id for product
    *
    * @param  void
    * @return integer
    * @author Andreas Nyholm
    * @access public
    */
    public function getTaxTypeId()
    {
        return $this->getProduct()->getTaxTypeId();
    }    

   /**
    * Get tax title for product
    *
    * @param  void
    * @return integer
    * @author Andreas Nyholm
    * @access public
    */
    public function getTaxTitle()
    {
        if($this->getProduct()->getTaxTypeId())
        return $this->getProduct()->getTaxType()->getTitle();
    }    
    
   /**
    * Do product have options
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getHasOptions()
    {
        return $this->getProduct()->getHasOptions();
    }    
    
    
}
