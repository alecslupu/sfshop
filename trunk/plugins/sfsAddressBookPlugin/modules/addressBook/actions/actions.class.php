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
        $this->pager = new sfPropelPager('sfsAddressBook', 10);
        $criteria = new Criteria();
        $criteria->add(sfsAddressBookPeer::MEMBER_ID, $this->getUser()->getMemberId());
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
        $address = $this->getAddressOrCreate();
        $this->form = new sfsAddressBookForm($address);
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('address'));
            
            if ($this->form->isValid()) {
                $address = $this->form->updateObject();
                $address->save();
                
                $this->redirect('@addressBook_myAddressesList');
            }
        }
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
        if (!$this->getRequestParameter($id)) {
            $address = new sfsAddressBook();
        }
        else {
            $address = sfsAddressBookPeer::retrieveByPk($this->getRequestParameter($id));
            $this->forward404Unless($address);
        }
        
        return $address;
    }
}
