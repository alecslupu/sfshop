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
 * Member form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class MemberForm extends BaseMemberForm
{
    public function configure()
    {
    	  unset(
           $this['id'],
           $this['credential'],
           $this['default_address_id'],
           $this['algorithm'],
           $this['salt'],
           $this['password'],
           $this['confirm_code'],
           $this['is_confirmed'],
           $this['is_deleted'],
           $this['is_active'],
           $this['access_num'],
           $this['created_at'],
           $this['updated_at'],
           $this['modified_at']
         );

        $this->setWidgets(
            array(
                'email'           => new sfWidgetFormInput(),
                'first_name'      => new sfWidgetFormInput(),
                'last_name'       => new sfWidgetFormInput(),
                'primary_phone'   => new sfWidgetFormInput(),
                'secondary_phone' => new sfWidgetFormInput()
             )
        );
        
        $validatorEmail = new sfValidatorAnd(
            array(
                new sfValidatorEmail(
                    array('required' => true),
                    array('invalid'  => 'This is not a valid email address')
                ),
                new sfsValidatorMember(
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
                'min_length' => 2,
                'max_length' => 255
            ),
            array(
                'required'   => 'First Name is a required field',
                'min_length' => 'First Name can not be less 2 characters',
                'max_length' => 'First Name can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 255
            ),
            array(
                'required'   => 'Last Name is a required field',
                'min_length' => 'Last Name can not be less 2 characters',
                'max_length' => 'Last Name can not be more 255 characters',
            )
        );
        
        $validatorPrimaryPhone = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 4,
                'max_length' => 15
            ),
            array(
                'required'   => 'Primary phone is a required field',
                'min_length' => 'Phone number can not be less 4 characters',
                'max_length' => 'Phone number can not be more 20 characters',
            )
        );
        
        $validatorSecondaryPhone = new sfValidatorString(
            array(
                'required'   => false,
                'min_length' => 4,
                'max_length' => 15
            ),
            array(
                'min_length' => 'Phone number can not be less 4 characters',
                'max_length' => 'Phone number can not be more 20 characters',
            )
        );
        
        $this->setValidators(
            array(
               'email'            => $validatorEmail,
               'first_name'       => $validatorFirstName,
               'last_name'        => $validatorLastName,
               'primary_phone'    => $validatorPrimaryPhone,
               'secondary_phone'  => $validatorSecondaryPhone
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
    }
}
