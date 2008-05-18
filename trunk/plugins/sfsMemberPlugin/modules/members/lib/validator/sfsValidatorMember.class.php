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
   *  * check_unique_email
   *  * check_exist_account
   *  * check_confirm_code
   *  * check_password
   *
   * Available error codes:
   *
   *  * check_login
   *  * check_unique_email
   *  * check_exist_account
   *  * check_confirm_code
   *
   * @see sfValidatorBase
   */
    protected function configure($options = array(), $messages = array())
    {
        $this->addMessage('check_login', 'You have wrong email or password');
        $this->addMessage('check_unique_email', 'Accout with this email alredy exist.');
        $this->addMessage('check_exist_account', 'Accout with this email does not exist.');
        $this->addMessage('check_secret_answer', 'The answer is wrong');
        $this->addMessage('check_confirm_code', 'The confirm code is wrong');
        $this->addMessage('check_password', 'The current password is wrong');
        
        $this->addOption('check_login');
        $this->addOption('check_unique_email');
        $this->addOption('check_exist_account');
        $this->addOption('check_secret_answer');
        $this->addOption('check_confirm_code');
        $this->addOption('check_password');
    }

    /**
    * Checks member for login, confim password, unique in database.
    * 
    * If option "check_login" is set, gets member object by email, checks password entered and password of member object. If
    * passwords do not match sets error.
    * 
    * If option "check_unique_email" is set, gets member object by email, if account exists with this email sets error.
    * 
    * If option "check_exist_account" is set, gets member object by email, if member does not exist with this email sets error.
    * 
    * If option "check_secret_answer" is set, gets member object by email and checks the answer on secret qustion entered by member
    * and answer of member object, if answers do not match sets error.
    * 
    * If option "check_confirm_code" is set, gets member object by confirm code, if member does not exist with such confim code sets error.
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
        
        if ($this->hasOption('check_login')) {
            $member = sfsMemberPeer::retrieveByEmail($value);
            
            $password = sfContext::getInstance()->getRequest()->getParameter('password');
            
            if (is_object($member)) {
                if ($member->checkPassword($password)) {
                    throw new sfValidatorError(
                        $this, 
                        'check_login', 
                        array('value' => $value, 'check_login' => $this->getOption('check_login'))
                    );
                }
            }
            else {
                throw new sfValidatorError(
                    $this, 
                    'check_login',
                     array('value' => $value, 'check_login' => $this->getOption('check_login'))
                );
            }
        }
        elseif ($this->hasOption('check_exist_account')) {
            $member = sfsMemberPeer::retrieveByEmail($value);
            
            if ($member == null) {
                throw new sfValidatorError(
                    $this, 
                    'check_exist_account', 
                    array('value' => $value, 'check_exist_account' => $this->getOption('check_exist_account'))
                );
            }
        }
        elseif ($this->hasOption('check_unique_email')) {
            $member = sfsMemberPeer::retrieveByEmail($value);
            $sfUser = sfContext::getInstance()->getUser();
            $ownEmail = false;
            
            if ($sfUser->isAuthenticated()) {
                if ($sfUser->getMember()->getEmail() == $value && $sfUser->getMemberId() == $member->getId()) {
                    $ownEmail = true;
                }
            }
            
            if ($member !== null && !$ownEmail) {
                throw new sfValidatorError(
                    $this, 'check_unique_email', 
                    array('value' => $value, 'check_unique_email' => $this->getOption('check_unique_email'))
                );
            }
        }
        elseif ($this->hasOption('check_confirm_code')) {
            $member = sfsMemberPeer::retrieveByConfirmCode($value);
            
            if ($member == null) {
                throw new sfValidatorError(
                    $this, 
                    'check_confirm_code', 
                    array('value' => $value, 'check_confirm_code' => $this->getOption('check_confirm_code'))
                );
            }
        }
        elseif ($this->hasOption('check_secret_answer')) {
            $email = sfContext::getInstance()->getRequest()->getParameter('email');
            $member = sfsMemberPeer::retrieveByEmail($email);
            
            if ($member->getSecretAnswer() !== $value) {
                throw new sfValidatorError(
                    $this, 
                    'check_secret_answer', 
                    array('value' => $value, 'check_secret_answer' => $this->getOption('check_secret_answer'))
                );
            }
        }
        elseif ($this->hasOption('check_password')) {
            $member =  sfContext::getInstance()->getUser()->getMember();
            
            if ($member->checkPassword($value)) {
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

