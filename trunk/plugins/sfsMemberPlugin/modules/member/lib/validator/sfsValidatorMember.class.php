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
   *  * check_unique_email
   *  * check_exist_account
   *  * check_password
   *
   * Available error codes:
   *
   *  * check_unique_email
   *  * check_exist_account
   *  * check_password
   *
   * @see sfValidatorBase
   */
    protected function configure($options = array(), $messages = array())
    {
        $this->addMessage('check_unique_email', 'Accout with this email alredy exist.');
        $this->addMessage('check_exist_account', 'Accout with this email does not exist.');
        $this->addMessage('check_password', 'The current password is wrong');
        
        $this->addOption('check_unique_email');
        $this->addOption('check_exist_account');
        $this->addOption('check_password');
    }

    /**
    * Checks member exist account, unique in database, current password.
    * 
    * If option "check_unique_email" is set, gets member object by email, if account exists with this email sets error.
    * 
    * If option "check_exist_account" is set, gets member object by email, if member does not exist with this email sets error.
    * 
    * If option "check_password" is set, checks password of current member and password inputed.
    * 
    * @param  string $value email value
    * @return string $clean, value of field
    * @author Dmitry Nesteruk
    * @access public
    */
    protected function doClean($value)
    {   
        $clean = $value;
        
        if ($this->hasOption('check_exist_account')) {
            $member = MemberPeer::retrieveByEmail($value);
            
            if ($member == null) {
                throw new sfValidatorError(
                    $this, 
                    'check_exist_account', 
                    array('value' => $value, 'check_exist_account' => $this->getOption('check_exist_account'))
                );
            }
        }
        elseif ($this->hasOption('check_unique_email')) {
            $member = MemberPeer::retrieveByEmail($value);
            $sfUser = sfContext::getInstance()->getUser();
            $ownEmail = false;
            
            if ($sfUser->isAuthenticated()) {
                if ($sfUser->getUser()->getEmail() == $value && $sfUser->getUserId() == $member->getId()) {
                    $ownEmail = true;
                }
            }
            
            if ($member !== null && !$ownEmail) {
                throw new sfValidatorError(
                    $this, 
                    'check_unique_email', 
                    array('value' => $value, 'check_unique_email' => $this->getOption('check_unique_email'))
                );
            }
        }
        elseif ($this->hasOption('check_password')) {
            $member =  sfContext::getInstance()->getUser()->getUser();
            
            if (!$member->checkPassword($value)) {
                throw new sfValidatorError(
                    $this, 
                    'check_password', 
                    array('value' => $value, 'check_password' => $this->getOption('check_password'))
                );
            }
        }
        
        return $clean;
    }
}
