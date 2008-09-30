<?php

/**
 * Subclass for representing a row from the 'admin' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.admin
 */ 
class Admin extends BaseAdmin
{
    
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
    * Get full admin name
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
    
   /**
    * Checks on match password entered and password of current admin
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
}
