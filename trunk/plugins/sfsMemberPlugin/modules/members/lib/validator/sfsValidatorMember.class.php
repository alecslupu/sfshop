<?php
/**
 * 
 * Validator checks member by entered parameters.
 * 
 * @package    sfShop
 * @subpackage plugins.sfsMemberPlugin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfGuardUserValidator.class.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfsValidatorMember extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * check_login
   *  * check_email
   *  * check_confirm_code
   *
   * Available error codes:
   *
   *  * check_login
   *  * check_email
   *  * check_confirm_code
   *
   * @see sfValidatorBase
   */
    protected function configure($options = array(), $messages = array())
    {
        $this->addMessage('check_login', 'You have wrong email or password.');
        $this->addMessage('check_email', 'Accout with this email alredy exist.');
        $this->addMessage('check_confirm_code', 'Confirm code is wrong.');
        
        $this->addOption('check_login');
        $this->addOption('check_email');
        $this->addOption('check_confirm_code');
    }

    /**
    * Checks member for login, confim password, unique in database.
    * 
    * If option "check_login" is set, gets member object by email, checks password entered and password of member object. If
    * passwords do not match set error.
    * 
    * If option "check_email" is set, gets member object by email, checks email is unique.
    * 
    * If option "check_confirm_code" is set, gets member object by confirm code, if member does not exist with such confim code sets errors.
    * 
    * @param  string $value email value
    * @return string $clean, value of field
    * @author Dmitry Nesteruk
    * @access public
    */
    protected function doClean($value)
    {
        $clean = $value;
        
        if ($this->hasOption('check_login')) {
            $member = sfsMemberPeer::retrieveByEmail($value);
            
            $password = sfContext::getInstance()->getRequest()->getParameter('password');
            
            if (is_object($member)) {
                if ($member->getCheckPassword($password)) {
                    throw new sfValidatorError($this, 'check_login', array('value' => $value, 'check_login' => $this->getOption('check_login')));
                }
            }
            else {
                throw new sfValidatorError($this, 'check_login', array('value' => $value, 'check_login' => $this->getOption('check_login')));
            }
        }
        elseif ($this->hasOption('check_email')) {
            $member = sfsMemberPeer::retrieveByEmail($value);
            
            if ($member !== null) {
                throw new sfValidatorError($this, 'check_email', array('value' => $value, 'check_email' => $this->getOption('check_email')));
            }
        }
        elseif ($this->hasOption('check_confirm_code')) {
            $member = sfsMemberPeer::retrieveByConfirmCode($value);
            
            if ($member == null) {
                throw new sfValidatorError($this, 'check_confirm_code', array('value' => $value, 'check_confirm_code' => $this->getOption('check_confirm_code')));
            }
        }
        
        return $clean;
    }
}

