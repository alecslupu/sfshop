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
 * 
 * Validator checks admin by entered parameters.
 * 
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.validator
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfsValidatorAdmin.class.php 613 2010-03-16 15:02:22Z nyholmsolutions $
 */
class sfsValidatorAdmin extends sfValidatorBase
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
        $this->addMessage('check_password', 'Current password is wrong');
        
        $this->addOption('check_unique_email');
        $this->addOption('check_exist_account');
        $this->addOption('check_password');
    }
    
    /**
    * Checks admin exist account, unique in database, current password.
    * 
    * If option "check_unique_email" is set, gets admin object by email, if account exists with this email sets error.
    * 
    * If option "check_exist_account" is set, gets admin object by email, if admin does not exist with this email sets error.
    * 
    * If option "check_password" is set, checks password of current admin and password inputed.
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
            $admin = AdminPeer::retrieveByEmail($value);
            
            if ($admin == null) {
                throw new sfValidatorError(
                    $this, 
                    'check_exist_account', 
                    array('value' => $value, 'check_exist_account' => $this->getOption('check_exist_account'))
                );
            }
        }
        elseif ($this->hasOption('check_unique_email')) {
            $admin = AdminPeer::retrieveByEmail($value);
            $sfUser = sfContext::getInstance()->getUser();
            $ownEmail = false;
            $adminParamater = sfContext::getInstance()->getRequest()->getParameter('admin');
            if ($admin != null
                && (
                    ($sfUser->isAuthenticated() && $sfUser->getUser()->getEmail() == $value
                        && $sfUser->getUserId() == $admin->getId()
                        && !$adminParamater['id']
                    )
                    || ($admin->getId() == $adminParamater['id'] && sfConfig::get('sf_app') == 'backend')
                )
            ) {
                $ownEmail = true;
            }
            
            if ($admin !== null && !$ownEmail) {
                throw new sfValidatorError(
                    $this, 
                    'check_unique_email', 
                    array('value' => $value, 'check_unique_email' => $this->getOption('check_unique_email'))
                );
            }
        }
        elseif ($this->hasOption('check_password')) {
            $admin =  sfContext::getInstance()->getUser()->getUser();
            
            if (!$admin->checkPassword($value)) {
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

