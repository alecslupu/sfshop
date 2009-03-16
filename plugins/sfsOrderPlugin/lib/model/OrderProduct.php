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
    * Gets saved product price based on product price (inclusive product options).
    * Taxes are include if app_tax_display_prices_with_tax = true
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getProductPrice()
    {
        if(!sfConfig::get('app_tax_display_prices_with_tax', false) || !sfConfig::get('app_tax_is_enabled', false))
            return $this->getNetPrice();
        return $this->getGrossPrice();
    }

   /**
    * Gets gross price based on saved product price and tax.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getGrossPrice()
    {
        return $this->getPrice() + $this->getTax();
    }
    
   /**
    * Gets net price based on saved product price and product options.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getNetPrice()
    {
        return $this->getPrice();
    }
        

  /**
    * Return price in database (net price)
    * Use getProductPrice() to get price with correct tax
    * 
    * @param  void
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */ 
     public function getPrice()
    {
       return parent::getPrice();
    }
     
   /**
    * Calculates total price for this product.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk, Andreas Nyholm
    * @access public
    */
    public function getTotalPrice()
    {
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getProductPrice(),$this->getOrderItem()->getCurrencyId(), true, true);
    }

   /**
    * Calculates total net price for this product.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getTotalNetPrice()
    {
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getNetPrice(),$this->getOrderItem()->getCurrencyId(), true, true);
    }

   /**
    * Calculates total gross price for this product.
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getTotalGrossPrice()
    {
        // use format_currency to get correct decimals and avoid rounding errors
        return $this->getQuantity() * format_currency($this->getGrossPrice(),$this->getOrderItem()->getCurrencyId(), true, true);
    }

    /**
    * Do order product have options
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getHasOptions()
    {
        if($this->countOrderProduct2OptionProducts())
            return true;
        return false;
    } 
    
    
}
