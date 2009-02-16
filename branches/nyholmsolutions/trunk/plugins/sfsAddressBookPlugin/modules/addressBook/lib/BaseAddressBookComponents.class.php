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
 * AddressBook components.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage modules.addressBook
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 */
class BaseAddressBookComponents extends sfComponents
{
   /**
    * Form for input address.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeInputForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
        if (isset($this->address)) {
            $address = $this->address;
            $isEditAddress = true;
        }
        else {
            $address = new AddressBook();
            
            $member = $this->getUser()->getUser();
            
            if ($member !== null) {
                $address->setFirstName($member->getFirstName());
                $address->setLastName($member->getLastName());
            }
        }
        
        $this->form = new sfsAddressBookInputForm($address);
        
        if (isset($isEditAddress)) {
            $this->form->getWidgetSchema()->offsetSet('id', new sfWidgetFormInputHidden());
            $this->form->setDefault('id', $address->getId());
        }
    }
    
   /**
    * Form for select exists address from address book.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    
    public function executeSelectAddress()
    {
        $this->hasAddresses = AddressBookPeer::hasAddresses($this->getUser()->getUserId());
    }
    
   /**
    * Gets details delivery address.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDeliveryAddress()
    {
        $addressId = $this->getUser()->getAttribute('address_id', null, 'order/delivery');
        $this->address = AddressBookPeer::retrieveById($addressId);
    }
    
   /**
    * Gets details billing address.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeBillingAddress()
    {
        $addressId = $this->getUser()->getAttribute('address_id', null, 'order/billing');
        $this->address = AddressBookPeer::retrieveById($addressId);
    }
}
