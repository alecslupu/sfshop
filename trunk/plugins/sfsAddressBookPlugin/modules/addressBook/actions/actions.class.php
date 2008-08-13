<?php

/**
 * addressBook actions.
 *
 * @package    sfShop
 * @subpackage addressBook
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class addressBookActions extends sfActions
{
   /**
    * My addresses list action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeMyList()
    {
        $this->pager = new sfPropelPager('AddressBook', 10);
        $criteria = new Criteria();
        $criteria->add(AddressBookPeer::MEMBER_ID, $this->getUser()->getUserId());
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();
    }
    
    public function executeCreate()
    {
        return $this->forward('addressBook', 'edit');
    }
    
   /**
    * Edit address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeEdit()
    {
        sfLoader::loadHelpers('I18N');
        
        $address = $this->getAddressOrCreate();
        $this->form = new AddressBookForm($address);
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('address'));
            
            if ($this->form->isValid()) {
                $address = $this->form->updateObject();
                $address->setCompany($this->getRequestParameter('address[company]'));
                $address->setIsDefault($this->getRequestParameter('address[is_default]'));
                $address->save();
                
                $this->redirect('@addressBook_myList');
            }
        }
    }
    
   /**
    * Checkes address data action and save address to session.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeAddAddressForOrder()
    {
        if (sfConfig::get('app_address_book_enabled', true)) {
            $this->form = new sfsOrderSelectAddressBookForm();
        }
        else {
            $this->form = new sfsOrderInputAddressBookForm();
        }
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('address'));
            
            if ($this->form->isValid()) {
                if ($this->getRequest()->isXmlHttpRequest()) {
                    
                    if ($this->hasRequestParameter('address[address_id]')) {
                        $address = AddressBookPeer::retrieveByPK($this->getRequestParameter('address[address_id]'));
                        
                        if ($address == null) {
                            if ($this->getRequest()->isXmlHttpRequest()) {
                                $this->renderText(sfsJSONPeer::createResponseSuccess(array('redirect_to' => url_for('@core_404'))));
                            }
                            else {
                                $this->forward404();
                            }
                        }
                        else {
                            $addressArray = $address->toArray(BasePeer::TYPE_FIELDNAME);
                        }
                    }
                    else {
                        $addressArray = $this->getRequestParameter('address');
                    }
                    $this->getUser()->setAttribute('address', $addressArray, 'order/delivery');
                    $this->getUser()->setAttribute('address', $addressArray, 'order/billing');
                    
                    if ($this->getRequest()->isXmlHttpRequest()) {
                        $this->renderText(sfsJSONPeer::createResponseSuccess(array('ok' => true)));
                    }
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
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $address = AddressBookPeer::retrieveByPk($this->getRequestParameter('id'));
            $this->forward404Unless($address);
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
    * @author Dmitry Nesteruk
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
