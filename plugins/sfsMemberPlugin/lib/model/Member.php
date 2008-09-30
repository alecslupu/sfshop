<?php

/**
 * Subclass for representing a row from the 'members' table.
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class Member extends BaseMember
{ 
   /**
    * Checks on match password entered and password of current member.
    *
    * @param  string $password
    * @return bool true if password is match, otherwise false
    * @author Dmitry Nesteruk
    * @access public
    */
    public function checkPassword($password)
    {
        return ($this->getPassword() == md5($password));
    }
    
    
    
   /**
    * Crypts password to md5.
    *
    * @param  string $value
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setPassword($value)
    {
        parent::setPassword(md5($value));
    }
    
    
    
   /**
    * Get full member name
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
    
    public function getGenderTitle() {
        sfLoader::loadHelpers('I18N');
        $title = __('none');
        foreach (MemberPeer::getGenders() as $key => $value) {
            if ($this->getGender() == $key) {
                $title = $value;
                break;
            }
        }
        return $title;
    }
}
