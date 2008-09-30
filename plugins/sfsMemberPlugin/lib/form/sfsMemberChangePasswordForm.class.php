<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
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
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberChangePasswordForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidgets(
            array(
                'current_password' => new sfWidgetFormInputPassword()
             ),
             $this->getWidgets()
        );
        
        $validatorCurrentPassword = new sfsValidatorMember(
            array(
                'required'   => true, 
                'check_password' => true, 
            )
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            'equal',
            'confirm_password',
            array(),
            array('invalid'  => 'Passwords do not match')
        );
        
        $this->setValidators(
            array(
               'current_password' => $validatorCurrentPassword
            ),
            $this->getValidators()
        );
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        $this->getWidgetSchema()->setNameFormat('change_password[%s]');
    }
}