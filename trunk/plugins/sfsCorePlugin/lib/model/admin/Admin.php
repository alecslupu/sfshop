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
 * Subclass for representing a row from the 'admin' table.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: Admin.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class Admin extends BaseAdmin
{
   /**
    * Sets credintial.
    * Converts credintial from array to string.
    * 
    * @param  mixed $value
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function setCredential($value)
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }
        
        parent::setCredential($value);
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
    * Get full admin name
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getFullName()
    {
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
