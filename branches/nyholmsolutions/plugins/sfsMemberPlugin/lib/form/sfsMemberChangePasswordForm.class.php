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
 * Member change password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsMemberChangePasswordForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidgets(
            array(
                'current_password' => new sfWidgetFormInputPassword(),
                'password'         => new sfWidgetFormInputPassword(),
                'confirm_password' => new sfWidgetFormInputPassword()
             )
        );
        
        $this->getWidgetSchema()->setLabels(
            array(
                'password'         => 'New password',
                'confirm_password' => 'Confirm new password'
            )
        );
        
        $validatorCurrentPassword = new sfsValidatorMember(
            array(
                'required'       => true,
                'check_password' => true
            ),
            array('required'   => 'Current password is a required field')
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 6,
                'max_length' => 200
            ),
            array(
                'required'   => 'New password is a required field',
                'min_length' => 'New password must be 6 or more characters',
                'max_length' => 'New password can not be more 200 characters'
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array('required' => true),
            array('required' => 'Confirm new password is a required field')
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            sfValidatorSchemaCompare::EQUAL,
            'confirm_password',
            array(),
            array('invalid'  => 'Passwords do not match')
        );
        
        $this->setValidators(
            array(
               'current_password' => $validatorCurrentPassword,
               'password'         => $validatorPassword,
               'confirm_password' => $validatorConfirmPassword
            )
        );
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
    }
}