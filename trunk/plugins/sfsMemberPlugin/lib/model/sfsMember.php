<?php

/**
 * Subclass for representing a row from the 'members' table.
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class sfsMember extends BasesfsMember
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
        return $this->getPassword() !== md5($password);
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
}
