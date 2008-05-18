<?php

/**
 * Class extends basic user class.
 *
 * @package    sfShop
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class myUser extends sfBasicSecurityUser
{

    /**
    * Sets member authenticated. 
    * 
    * Adds attributes for authenticated member, sets credential.
    *
    * @param  object $member
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function login($member)
    {
        $this->setAttribute('member_id', $member->getId(), 'member');
        $this->setAuthenticated(true);
        $this->addCredential('member');
        $this->setAttribute('email', $member->getEmail(), 'member');
        $this->setAttribute('first_name', $member->getFirstName(), 'member');
        $this->setAttribute('last_name', $member->getLastName(), 'member');
    }
    
    /**
    * Sets member unauthenticated. 
    * 
    * Removes all member's attributes from sessions, clears credential.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function logout()
    {
        $this->getAttributeHolder()->removeNamespace('member');
        $this->setAuthenticated(false);
        $this->clearCredentials();
    }
    
    /**
    * Gets member's full name from session.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getMemberName()
    {
        return $this->getAttribute('first_name', null, 'member').' '.$this->getAttribute('lastName', null, 'member');
    }
    
    /**
    * Gets member's id from session.
    *
    * @param  void
    * @return int if member is authenticated, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getMemberId()
    {
        if ($this->isAuthenticated()) {
            return $this->getAttribute('member_id', '', 'member');
        }
        else {
            return null;
        }
    }
    
    /**
    * Gets object member by member's id.
    *
    * @param  void
    * @return object if member is authenticated, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getMember()
    {
        if ($this->isAuthenticated()) {
            return sfsMemberPeer::retrieveByPk($this->getMemberId());
        }
        else {
            return null;
        }
    }
    
    /**
    * Gets member's location.
    *
    * @param  void
    * @return string $location.
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getLocation()
    {
        return 'US';
    }
}
