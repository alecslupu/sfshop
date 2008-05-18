<?php

/**
 * Subclass for performing query and update operations on the 'address_book' table.
 *
 * 
 *
 * @package plugins.sfsAddressBookPlugin.lib.model
 */ 
class sfsAddressBookPeer extends BasesfsAddressBookPeer
{
    
    /**
    * Saves data entered by user.
    *
    * @param  array $field associate array with values of address book.
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function saveAddressBook(array $fields, sfsAddressBook $addressBook = null)
    {
        if ($addressBook == null) {
            $addressBook = new sfsAddressBook();
        }
        
        $addressBook->fromArray($fields, BasePeer::TYPE_FIELDNAME);
        $addressBook->save();
        return $addressBook;
    }
    
    /**
    * Gets addresses list of member.
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
}
