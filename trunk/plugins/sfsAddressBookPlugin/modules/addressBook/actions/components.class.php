<?php

/**
 * AddressBook components.
 *
 * @package    sfShop
 * @subpackage addressBook
 * @author     Dmitry Nesteruk
 */
class addressBookComponents extends sfComponents
{
   /**
    * Form for set address in the order list.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeOrderAddressForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
        if (sfConfig::get('app_address_book_enabled', true)) {
            $this->form = new sfsOrderSelectAddressBookForm();
            
            $default = AddressBookPeer::retrieveDefaultByMemberId($this->getUser()->getUserId());
            
            $defaultAddressId = '';
            
            if ($default !== null) {
                $defaultAddressId = $default->getId();
            }
            
            $this->form->setDefault('address_id', $defaultAddressId);
        }
        else {
            $address = new AddressBook();
            
            if ($this->getUser()->getAttributeHolder()->hasNamespace('order/delivery/address')) {
                $addressData = $this->getUser()->getAttributeHolder()->getAll('order/delivery/address');
                $address->fromArray($addressData, BasePeer::TYPE_FIELDNAME);
            }
            else {
                $member = $this->getUser()->getUser();
                if ($member === null) {
                    $address->setGender(1);
                    $address->setFirstName('');
                    $address->setLastName('');
                }
                else {
                    $address->setGender($member->getGender());
                    $address->setFirstName($member->getFirstName());
                    $address->setLastName($member->getLastName());
                }
            }
            
            $this->form = new sfsOrderInputAddressBookForm($address);
        }
    }
    
   /**
    * Gets details delivery address.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDeliveryAddress()
    {
        $address = $this->address;
        $this->address = new AddressBook();
        $this->address->fromArray($address, BasePeer::TYPE_FIELDNAME);
    }
}
