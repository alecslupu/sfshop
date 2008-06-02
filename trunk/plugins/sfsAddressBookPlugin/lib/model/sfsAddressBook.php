<?php

/**
 * Subclass for representing a row from the 'address_book' table.
 *
 * 
 *
 * @package plugins.sfsAddressBookPlugin.lib.model
 */ 
class sfsAddressBook extends BasesfsAddressBook
{
    /**
    * Redefined parent's function setIsDefault.
    * 
    * Unsets old default address and sets new address as default for this member.
    * 
    * @param  int $value 0 or 1
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setIsDefault($value)
    {
        if ($value == 1) {
            $criteriaWhere = new Criteria();
            $criteriaWhere->add(sfsAddressBookPeer::MEMBER_ID, $this->getMemberId());
            $criteriaWhere->add(sfsAddressBookPeer::IS_DEFAULT, 1);
            
            $criteriaSet = new Criteria();
            $criteriaSet->add(sfsAddressBookPeer::IS_DEFAULT, 0);
            BasePeer::doUpdate($criteriaWhere, $criteriaSet, $con);
        }
        
        parent::setIsDefault($value);
    }
}
