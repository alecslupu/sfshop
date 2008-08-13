<?php

/**
 * Subclass for performing query and update operations on the 'address_book' table.
 *
 * 
 *
 * @package plugins.sfsAddressBookPlugin.lib.model
 */ 
class AddressBookPeer extends BaseAddressBookPeer
{
   /**
    * Saves data entered by user.
    *
    * @param  array $field associate array with values of address book.
    * @return object
    * @author Dmitry Nesteruk
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
    * Gets addresses by memberId.
    *
    * @param  int $memberId
    * @return mixed if member exist returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByMemberId($memberId)
    {
        $criteria = new Criteria();
        $criteria->add(self::MEMBER_ID, $memberId);
        return self::doSelect($criteria);
    }
    
   /**
    * Gets addresses hash array by memberId.
    *
    * @param  int $memberId
    * @return array
    * @author Dmitry Nesteruk
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
    * Gets default address for some member by memberId.
    *
    * @param  int $memberId
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveDefaultByMemberId($memberId)
    {
        $criteria = new Criteria();
        $criteria->add(self::MEMBER_ID, $memberId);
        $criteria->add(self::IS_DEFAULT, 1);
        return self::doSelectOne($criteria);
    }
}
