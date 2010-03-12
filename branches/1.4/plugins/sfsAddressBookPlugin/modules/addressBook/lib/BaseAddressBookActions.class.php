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
 * Base addressBook actions.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage modules.addressBook
 * @author     Dmitry Nesteruk  <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseAddressBookActions extends sfActions
{
   /**
    * My addresses list action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeMyList($request)
    {
        $this->pager = new sfPropelPager('AddressBook', 10);
        $criteria = new Criteria();
        $criteria->add(AddressBookPeer::MEMBER_ID, $this->getUser()->getUserId());
        $criteria->addDescendingOrderByColumn(AddressBookPeer::CREATED_AT);
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
    
   /**
    * Create address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCreate()
    {
        return $this->forward('addressBook', 'edit');
    }
    
   /**
    * Edit address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeEdit($request)
    {
        $this->getContext()->getConfiguration()->loadHelpers('I18N');
        $sfUser = $this->getUser();
        $address = $this->getAddressOrCreate();
        $this->form = new AddressBookForm($address);
        
        if ($request->isMethod('post')) {
            $data = $request->getParameter('data');
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                $address = $this->form->updateObject();
                $address->setCompany($data['company']);
                
                if (isset($data['is_default'])) {
                    $address->setIsDefault(true);
                }
                else {
                    $address->setIsDefault(false);
                }
                
                $address->save();
                
                if ($request->isXmlHttpRequest()) {
                    if ($request->hasParameter('is_return_all_addresses')) {
                        
                        $arrayAddresses = AddressBookPeer::getHashByMemberId($this->getUser()->getUserId());
                        
                        $data = array(
                            'addresses'          => $arrayAddresses,
                            'default_address_id' => $address->getId()
                        );
                        
                        return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
                    }
                    else {
                        
                        $data = $address->toArray(BasePeer::TYPE_FIELDNAME);
                        $data['country'] = CountryPeer::retrieveByPK($data['country_id'])->getTitle();
                        if($data['state_id'])
                            $data['state'] = StatePeer::retrieveByPK($data['state_id'])->getTitle();
                        
                        return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
                    }
                }
                else {
                    
                    if ($address->isNew()) {
                        $isNew = true;
                        $sfUser->setFlash('message', __('New address has been added'));
                    }
                    else {
                        $sfUser->setFlash('message', __('Address has been saved'));
                    }
                    
                    $this->redirect('@addressBook_myList');
                }
            }
            elseif ($request->isXmlHttpRequest()) {
                $errors = array();
                
                foreach ($this->form->getErrorSchema() as $field => $error) {
                    $errors[$field] = $error->getMessage();
                }
                
                return $this->renderText(sfsJSONPeer::createResponseError($errors));
            }
        }
    }
    
   /**
    * Checkes address data action and save address to session.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeSelect($request)
    {
        $this->getContext()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
        
        $this->form = new sfsAddressBookSelectForm();
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('data'));
            
            if ($this->form->isValid()) {
                $address = AddressBookPeer::retrieveByPK($this->getRequestParameter('data[address_id]'));
                
                if ($address == null || $address->getMemberId() != $this->getUser()->getUserId()) {
                    if ($this->getRequest()->isXmlHttpRequest()) {
                        $this->renderText(sfsJSONPeer::createResponseSuccess(array('redirect_to' => url_for('@core_error404'))));
                    }
                    else {
                        $this->forward404();
                    }
                }
                
                $this->getUser()->setAttribute('address_id', $address->getId(), 'order/delivery');
                $this->getUser()->setAttribute('address_id', $address->getId(), 'order/billing');
                if($address->getTaxGroupId())
                    $this->getUser()->setAttribute('tax_group_id', $address->getTaxGroupId(), 'order/tax');
                
                if ($this->getRequest()->isXmlHttpRequest()) {
                    $this->renderText(sfsJSONPeer::createResponseSuccess(array('ok' => true)));
                }
            }
            else {
                $errors = array();
                
                foreach ($this->form->getErrorSchema() as $field => $error) {
                    $errors[$field] = $error->getMessage();
                }
                
               $this->renderText(sfsJSONPeer::createResponseError($errors));
            }
        }
        
        return sfView::NONE;
    }
    
   /**
    * Delete address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $address = AddressBookPeer::retrieveByPk($this->getRequestParameter('id'));
            if ($address == null || $address->getMemberId() != $this->getUser()->getUserId()) {
                $this->forward404();
            }
            $address->delete();
        }
        
        $this->redirect('@addressBook_myList');
    }
    
   /**
    * Gets address object.
    * 
    * If parameter id is set, returns object with exist address, otherwise creates object for new record.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access protected
    */
    protected function getAddressOrCreate($id = 'id')
    {
        if ($this->hasRequestParameter($id)) {
            $address = AddressBookPeer::retrieveByPk($this->getRequestParameter($id));
            
            if ($address == null || $address->getMemberId() != $this->getUser()->getUserId()) {
                $this->forward404();
            }
        }
        else {
            $address = new AddressBook();
            $address->setMemberId($this->getUser()->getUserId());
        }
        
        return $address;
    }
}
