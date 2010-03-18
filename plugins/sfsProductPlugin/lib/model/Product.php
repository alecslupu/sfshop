<?php

/**
 * Subclass for representing a row from the 'products' table.
 *
 *
 *
 * @package plugins.sfsProductPlugin.lib.model
 */
class Product extends BaseProduct
{
    protected $hasOptions = null;

    public function __toString() 
    {
        return $this->getTitle();    
    }
    
    /**
     * Generate slug from title. Note! Slug is not persistant
     * Queries should depend on id.
     * 
     * @return string
     * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
     * @access public
     */
    public function getSlug()
    {
      return sfShop_Inflector::urlize($this->getTitle());
   }
    
   /**
    * Gets thumbnail object for current product.
    *
    * @param  string $type
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getThumbnail($thumbnailType)
    {
        return ThumbnailPeer::retrieveByTypeAndAssetId($thumbnailType, $this->getId(), get_class($this));
    }

   /**
    * Gets brand optin for product with translation.
    *
    * @param  object $con
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getBrand(PropelPDO $con = null)
    {
        if ($this->getBrandId() !== null) {

            $criteria = new Criteria();
            $criteria->add(BrandPeer::ID, $this->getBrandId());
            list($brand) = BrandPeer::doSelectWithTranslation($criteria);
            return $brand;
        }
        else {
            return null;
        }
    }

    public function setCategoryId($categoryId)
    {
        $this->save();

        $c = new Criteria();
        $c->addAnd(Product2CategoryPeer::PRODUCT_ID, $this->getId(), Criteria::EQUAL);
        foreach (Product2CategoryPeer::doSelect($c) as $p2c) {
            $p2c->delete();
        }

        $p2c = new Product2Category();
        $p2c->setProductId($this->getId());
        $p2c->setCategoryId($categoryId);
        $p2c->save();
    }

    public function getCategoryId()
    {
        $c = new Criteria();
        $c->addAnd(Product2CategoryPeer::PRODUCT_ID, $this->getId(), Criteria::EQUAL);

        if (($p2c = Product2CategoryPeer::doSelectOne($c)) !== null) {
            return $p2c->getCategoryId();
        }
        return null;
    }

   /**
    * Return product quantity. Also depend on option quantity
    * 
    * @param  $options
    * @return integer
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */ 
     public function getProductQuantity($optionsList = null)
    {
    	if(!$this->getHasOptions() || $this->getQuantity() !== null)
         return $this->getQuantity();

      $amount = 0;
      $options = $this->getOptionProducts();
      foreach($options as $option) {
      	if($optionsList) {
      		foreach($optionsList as $ol){
      			// return first not null value
      			if($ol == $option->getId() && $option->getQuantity() !== null)
      			 return $option->getQuantity();
      		}
      	}
      	else
         $amount += $option->getQuantity(); //assume user is using only one option type for quantity
      }
      return $amount;      
    }
    
   /**
    * Return quantity in database 
    * Use getProductQuantity() to get quantity from options
    * 
    * @param  void
    * @return integer
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */ 
     public function getQuantity()
    {
       return parent::getQuantity();
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
    * Gets gross product price
    * Net price is returned if taxes are globally disabled
    *
    * @param  void
    * @return string
    * @author Andreas Nyholm
    * @access public
    */
    public function getGrossPrice()
    {
        return $this->calculateGrossPrice($this->getPrice());
    }
    
   /**
    * Gets net product price
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
    * Gets product price, including or excluding taxes
    * Net price is returned if taxes are globally disabled
    * 
    * @param  void
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */ 
     public function getProductPrice()
    {

        if(!sfConfig::get('app_tax_display_prices_with_tax', false))
            return $this->getPrice();

        return TaxRatePeer::calculateGrossPrice($this->getPrice(),$this->getTaxTypeId());
    }

   /**
    * Wrapper for TaxRatePeer::calculateGrossPrice
    * Net price is returned if taxes are globally disabled
    * 
    * @param  decimal $price
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
     public function calculateGrossPrice($price)
    {
    	  return TaxRatePeer::calculateGrossPrice($price,$this->getTaxTypeId());
    }    
   
}

xfPropelBehavior::register('Product', array('ProductSearchGroup'));
