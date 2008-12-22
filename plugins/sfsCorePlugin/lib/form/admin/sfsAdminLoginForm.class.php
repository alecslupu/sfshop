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
 * Admin login form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.administratorAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsAdminLoginForm extends AdminForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidgets(
            array(
                'email'    => new sfWidgetFormInput(),
                'password' => new sfWidgetFormInputPassword()
             )
        );
        
        $validatorEmail = new sfValidatorString(
            array('required' => true),
            array('required' => 'Email is a required field')
        );
        
        
        $validatorPassword = new sfValidatorString(
            array('required' => true),
            array('required' => 'Password is a required field')
        );
        
        $this->setValidators(
            array(
                'email'     => $validatorEmail,
                'password'  => $validatorPassword
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('admin[%s]');
    }
}