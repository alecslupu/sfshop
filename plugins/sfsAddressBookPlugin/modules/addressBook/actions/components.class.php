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
 * AddressBook components.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage modules.addressBook
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 */
class addressBookComponents extends sfComponents
{
   /**
    * Form for set address in the order list.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeOrderAddressForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
        if (sfConfig::get('app_address_book_enabled', true)) {
            $this->form = new sfsOrderSelectAddressBookForm();
            
            $default = AddressBookPeer::retrieveDefaultByMemberId($this->getUser()->getUserId());
            
            if ($default !== null) {
                $defaultAddressId = $default->getId();
                $this->form->setDefault('address_id', $default->getId());
            }
        }
        else {
            $address = new AddressBook();
            
            if ($this->getUser()->getAttributeHolder()->hasNamespace('order/delivery/address')) {
                $addressData = $this->getUser()->getAttributeHolder()->getAll('order/delivery/address');
                $address->fromArray($addressData, BasePeer::TYPE_FIELDNAME);
            }
            else {
                
                $member = $this->getUser()->getUser();
                
                if ($member !== null) {
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
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeDeliveryAddress()
    {
        $address = $this->address;
        $this->address = new AddressBook();
        $this->address->fromArray($address, BasePeer::TYPE_FIELDNAME);
    }
    
   /**
    * Gets details billing address.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeBillingAddress()
    {
        $address = $this->address;
        $this->address = new AddressBook();
        $this->address->fromArray($address, BasePeer::TYPE_FIELDNAME);
    }
}
