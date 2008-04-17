<?php

/**
 * Subclass for performing query and update operations on the 'address_book' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
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
    public static function saveAddressBook(array $fields)
    {
        $addressBook = new sfsAddressBook();
        $addressBook->fromArray($fields);
        $addressBook->save();
        return $addressBook;
    }
}
