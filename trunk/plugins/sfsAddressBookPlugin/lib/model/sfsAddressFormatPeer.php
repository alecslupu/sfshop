<?php

/**
 * Subclass for performing query and update operations on the 'address_format' table.
 *
 * 
 *
 * @package plugins.sfsAddressBookPlugin.lib.model
 */ 
class sfsAddressFormatPeer extends BasesfsAddressFormatPeer
{
    protected static $format = array();
    protected static $defaultFormat = null;
    
    /**
    * Get address format object by location.
    *
    * @param  string $location
    * @return mixed if format exist for this location returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByLocation($location)
    {
        if (isset(self::$format[$location])) {
            return self::$format[$location];
        }
        else {
            $criteria = new Criteria();
            $criteria->add(self::LOCATION, $location);
            $format = self::doSelectOne($criteria);
            self::$format[$location] = $format;
            return $format;
        }
    }
    
    /**
    * Get default address format. Uses if address format for some location does not exist.
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveDefault()
    {
        if (self::$defaultFormat !== null) {
            return self::$defaultFormat;
        }
        else {
            $criteria = new Criteria();
            $criteria->add(self::IS_DEFAULT, 1);
            $default = self::doSelectOne($criteria);
            self::$default = $default;
            return $default;
        }
    }
}
