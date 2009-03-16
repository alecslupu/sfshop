<?php

/**
 * Class extends basic user class
 *
 * @package    sfShop
 * @author     Dmitry Nesteruk, Andrey Kotlyarov
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfsFrontendSecurityUser extends sfsSecurityUser
{
    protected $model    = 'member';
    protected $basket   = null;
    protected $currency = null;
    protected $taxGroup = null;
    
    
    
   /**
    * Initialization member and basket object for session
    * 
    * @param boolean $isForced
    * @return void
    * @author Andrey Kotlyarov
    * @access public
    */
    public function init($isForced = false)
    {
        parent::init($isForced);
        
        if ($isForced || $this->basket === null) {
            $this->basket = null;
            
            $cookieName   = sfConfig::get('app_basket_coo_name', 'basket_id');
            $cookieExpire = time() + 1*sfConfig::get('app_basket_coo_expire', '604800');
            
            $basket_id = sfContext::getInstance()->getRequest()->getCookie($cookieName, null);
            
            $this->basket = BasketPeer::generate(
                ($this->user === null ? null : $this->user->getId()),
                $basket_id
            );
            
            sfContext::getInstance()->getResponse()->setCookie(
                $cookieName,
                $this->basket->getId(),
                $cookieExpire,
                '/'
            );
        }
    }
    
    
    
   /**
    * Gets basket object from session
    * 
    * @param void
    * @return object (Basket class object)
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getBasket()
    {
        return $this->basket;
    }
    
    
    
   /**
    * Gets member's location
    *
    * @param  void
    * @return string $location.
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getLocation()
    {
        return 'US';
    }
    
   /**
    * Gets member's tax group
    *
    * @param  void
    * @return integer $stateId.
    * @author Andreas Nyholm
    * @access public
    */
    public function getTaxGroup() 
    {
        return  $this->taxGroup;
    }
    
    
   /**
    * Gets member's currency from session
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getCurrency()
    {
        return $this->currency;
    }
    
}
