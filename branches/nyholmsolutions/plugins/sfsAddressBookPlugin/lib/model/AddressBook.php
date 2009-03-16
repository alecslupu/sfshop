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
 * Subclass for representing a row from the 'address_book' table.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: AddressBook.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class AddressBook extends BaseAddressBook
{
   /**
    * Redefined parent's function setIsDefault.
    * 
    * Unmarks old default address and marks new address as default.
    * 
    * @param  int $value 0 or 1
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function setIsDefault($value)
    {
        if ($value == true) {
            $con = Propel::getConnection();
            
            $criteriaWhere = new Criteria();
            $criteriaWhere->add(AddressBookPeer::MEMBER_ID, $this->getMemberId());
            $criteriaWhere->add(AddressBookPeer::IS_DEFAULT, 1);
            $criteriaWhere->add(AddressBookPeer::ID, $this->getId(), Criteria::NOT_EQUAL);
            
            $criteriaSet = new Criteria();
            $criteriaSet->add(AddressBookPeer::IS_DEFAULT, 0);
            BasePeer::doUpdate($criteriaWhere, $criteriaSet, $con);
        }
        
        parent::setIsDefault($value);
    }
}
