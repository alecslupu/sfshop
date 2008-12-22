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
 * Admin form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class AdminForm extends BaseAdminForm
{
    public function configure()
    {
        $arrayCredentials = array(
            'superadmin' => 'superadmin', 
            'admin'      => 'admin'
        );
        
        $this->setWidgets(array(
            'id'          => new sfWidgetFormInputHidden(),
            'credential'  => new sfWidgetFormSelect(array('choices' => $arrayCredentials), array('multiple' => true)),
            'email'       => new sfWidgetFormInput(array(), array('size' => 60)),
            'first_name'  => new sfWidgetFormInput(array(), array('size' => 60)),
            'last_name'   => new sfWidgetFormInput(array(), array('size' => 60)),
            'is_active'   => new sfWidgetFormInputCheckbox()
        ));
        
        $validatorCredential = new sfValidatorChoice(
            array('choices'  => array_keys($arrayCredentials)),
            array('invalid'  => 'Please select a credential')
        );
        
        $validatorEmail = new sfValidatorAnd(
            array(
                new sfValidatorEmail(
                    array('required' => true),
                    array('invalid'  => 'This is not a valid email address')
                ),
                new sfsValidatorAdmin(
                    array('check_unique_email' => true),
                    array('check_unique_email' => 'An account with this email already exists')
                )
            ),
            array('required' => true),
            array('required' => 'Email is a required field')
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'First Name is a required field',
                'max_length' => 'First Name can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'Last Name is a required field',
                'max_length' => 'Last Name can not be more 255 characters',
            )
        );
        
        $this->setValidators(array(
            'id'          => new sfValidatorPropelChoice(array('model' => 'Admin', 'column' => 'id', 'required' => false)),
            'credential'  => $validatorCredential,
            'email'       => $validatorEmail,
            'first_name'  => $validatorFirstName,
            'last_name'   => $validatorLastName,
            'is_active'   => new sfValidatorBoolean()
        ));
        
        $this->getWidgetSchema()->setNameFormat('admin[%s]');
    }
}
