<?php

/**
 * Subclass for performing query and update operations on the 'currencies' table.
 *
 * 
 *
 * @package plugins.sfsCurrencyPlugin.lib.model
 */ 
class CurrencyPeer extends BaseCurrencyPeer
{
    protected static $default = null;
    
   /**
    * Get default currency
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveDefault()
    {
        if (self::$default == null) {
            $criteria = new Criteria();
            $criteria->add(self::IS_DEFAULT, 1);
            self::$default = self::doSelectOne($criteria);
        }
        
        return self::$default;
    }
    
   /**
    * Get currency object by code.
    *
    * @param  string $code
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByCode($code)
    {
        $criteria = new Criteria();
        $criteria->add(self::CODE, $code);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Gets hash array of currencies.
    *
    * @param  $criteria
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getHash($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $currencies = self::doSelectWithTranslation($criteria);
        
        $hash = array();
        
        if (count($currencies) > 0) {
            foreach ($currencies as $currency) {
                $hash[$currency->getId()] = $currency->getTitle();
            }
        }
        
        return $hash;
    }
    
   /**
    * Checks existence currencies by currency codes.
    * 
    * This function may use for check existence any currency from currencies list.
    * If any currency from list is exist, return true otherwise false.
    * 
    * @param  string $codes
    * @return bool
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function checkExistenceByCodes($codes, $criteria)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::CODE, $codes, Criteria::IN);
        return self::doCount($criteria) > 0 ? true : false;
    }
}
