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
 * Subclass for performing query and update operations on the 'address_format' table.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: AddressBookPeer.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class AddressFormatPeer extends BaseAddressFormatPeer
{
    protected static $format = array();
    protected static $default = null;
    
   /**
    * Get address format object by location.
    *
    * @param  string $location
    * @return mixed if format exist for this location returns object, otherwise null.
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function retrieveByLocation($location)
    {
        if (!isset(self::$format[$location])) {
            $criteria = new Criteria();
            $criteria->add(self::LOCATION, $location);
            self::$format[$location] = self::doSelectOne($criteria);
        }
        
        return self::$format[$location];
    }
    
   /**
    * Gets default address format.
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
}
