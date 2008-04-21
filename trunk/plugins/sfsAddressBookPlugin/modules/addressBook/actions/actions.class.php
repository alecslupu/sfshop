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
    public function executeMyAddressesList()
    {
        $this->pager = new sfPropelPager('sfsAddressBook', 10);
        $criteria = new Criteria();
        $criteria->add(sfsAddressBookPeer::MEMBER_ID, $this->getUser()->getMemberId());
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();
    }
    
    /**
    * Edit address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeEditAddress()
    {
        $this->form = new sfsAddressBookForm();
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('address'));
            
            if ($this->form->isValid()) {
                $addressBook = sfsAddressBookPeer::saveAddressBook($address);
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
    public function executeDeleteAddress()
    {
        
    }
}
