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
    * Form for input address.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeInputForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
        $address = new AddressBook();
        
        if ($this->getUser()->getAttributeHolder()->hasNamespace('order/delivery/address')) {
            $addressData = $this->getUser()->getAttributeHolder()->getAll('order/delivery/address');
            $address->fromArray($addressData, BasePeer::TYPE_FIELDNAME);
        }
        else {
            $member = $this->getUser()->getUser();
            
            if ($member !== null) {
                $address->setFirstName($member->getFirstName());
                $address->setLastName($member->getLastName());
            }
        }
        
        $this->form = new sfsAddressBookInputForm($address);
    }
    
   /**
    * Form for select exists address from address book.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeSelectForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
        $this->form = new sfsAddressBookSelectForm();
        
        $default = AddressBookPeer::retrieveDefaultByMemberId($this->getUser()->getUserId());
        
        if ($default !== null) {
            $defaultAddressId = $default->getId();
            $this->form->setDefault('address_id', $default->getId());
        }
        
        $this->hasAddresses = AddressBookPeer::hasAddresses($this->getUser()->getUserId());
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
