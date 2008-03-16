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
   *
   * Available error codes:
   *
   *  * check_login
   *
   * @see sfValidatorBase
   */
    protected function configure($options = array(), $messages = array())
    {
        $this->addMessage('check_login', 'You have wrong email or password.');
        $this->addOption('check_login');
    }

    /**
    * Checks member is unique in database.
    * 
    * Gets member object by email.
    * 
    * If option "check_login" is set, checks password entered and password of member object. If
    * passwords do not match set error and returns false, returns true otherwise.
    * 
    * @param  string $value email value
    * @return bool false if member exist with this email and password, false otherwise
    * @author Dmitry Nesteruk
    * @access public
    */
    protected function doClean($value)
    {
        $member = sfsMemberPeer::retrieveByEmail($value);

        if ($this->hasOption('check_login')) {

            $password = sfContext::getInstance()->getRequest()->getParameter('password');

            if (is_object($member)) {
                if ($member->getPassword() == md5($password)) {
                    throw new sfValidatorError($this, 'check_login', array('value' => $value, 'check_login' => $this->getOption('check_login')));
                }
            }
            else {
                throw new sfValidatorError($this, 'check_login', array('value' => $value, 'check_login' => $this->getOption('check_login')));
            }
        }

        return $clean;
    }
}

