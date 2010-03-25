<?php

/**
 * Subclass for representing a row from the 'option_product' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionProduct extends BaseOptionProduct
{
    public function __toString() 
    {
        if($this->getOptionValue())
            return $this->getOptionValue()->getOptionType()->getTitle().': '.$this->getOptionValue()->getTitle();
        return ' ';
    }
    
    public function getOptionType() 
    {
        if($this->getOptionValue())
        {
            return $this->getOptionValue()->getOptionType();
        }
    }
    
    public function getOptionValueJoinOptionType()
    {
        $criteria = new Criteria();
        $criteria->add(OptionValuePeer::ID, $this->getOptionValueId());
        list($optionValue) = OptionValuePeer::doSelectJoinOptionType($criteria);
        return $optionValue;
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
    * Gets gross product option price
    * Net price is returned if taxes are globally disabled
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getGrossPrice()
    {
        // check if tax is enabled here to avoid unnecessary db-queries
        if(!sfConfig::get('app_tax_is_enabled', false)) 
            return $this->getPrice();
        return $this->getProduct()->calculateGrossPrice($this->getPrice());
    }
    
   /**
    * Gets net product option price
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
    * Gets product option price, including or excluding taxes
    * Gross price is never returned if taxes are globally disabled
    * 
    * @param  void
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
     public function getProductPrice()
    {
        // check if tax is enabled here to avoid unnecessary db-queries
        if(!sfConfig::get('app_tax_is_enabled', false)) 
            return $this->getPrice();

        if(!sfConfig::get('app_tax_display_prices_with_tax', false))
            return $this->getPrice();

        return $this->getProduct()->calculateGrossPrice($this->getPrice());
    }
    
}
