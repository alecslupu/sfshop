<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Subclass for performing query and update operations on the 'address_book' table.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: AddressBookPeer.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class AddressBookPeer extends BaseAddressBookPeer
{
   /**
    * Saves data entered by user.
    *
    * @param  array $field associate array with values of address book.
    * @return object
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function saveAddressBook(array $fields, AddressBook $addressBook = null)
    {
        if ($addressBook == null) {
            $addressBook = new AddressBook();
        }
        
        $addressBook->fromArray($fields, BasePeer::TYPE_FIELDNAME);
        $addressBook->save();
        return $addressBook;
    }
    
   /**
    * Gets all addresses by memberId.
    *
    * @param  int $memberId
    * @return mixed if member exist returns object, otherwise null.
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function getByMemberId($memberId)
    {
        $criteria = new Criteria();
        $criteria->add(self::MEMBER_ID, $memberId);
        return self::doSelect($criteria);
    }
    
   /**
    * Gets addresses hash by memberId.
    *
    * @param  int $memberId
    * @return array
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function getHashByMemberId($memberId)
    {
        sfLoader::loadHelpers('sfsAddressBook');
        
        $addresses = self::getByMemberId($memberId);
        
        $hash = array();
        
        if (count($addresses) > 0) {
            foreach ($addresses as $address) {
                $hash[$address->getId()] = format_address($address, false);
            }
        }
        
        return $hash;
    }
    
   /**
    * Gets default address by memberId.
    *
    * @param  int $memberId
    * @return object
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function retrieveDefaultByMemberId($memberId)
    {
        $criteria = new Criteria();
        $criteria->add(self::MEMBER_ID, $memberId);
        $criteria->add(self::IS_DEFAULT, 1);
        return self::doSelectOne($criteria);
    }
    
   /**
    * If member has addresses, return true, otherwise false.
    *
    * @param  int $memberId
    * @return bool
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function hasAddresses($memberId)
    {
        $criteria = new Criteria();
        $criteria->add(self::MEMBER_ID, $memberId);
        return (self::doCount($criteria) > 0);
    }
}
