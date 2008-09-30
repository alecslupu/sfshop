<?php

/**
 * Member form.
 *
 * @package    form
 * @subpackage members
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class MemberForm extends BaseMemberForm
{
    public function configure()
    {
        
        $arrayGenders = MemberPeer::getGenders();
        
        $this->setWidgets(
            array(
                //'gender'             => new sfWidgetFormSelect(array('choices' => $arrayGenders)),
                'email'              => new sfWidgetFormInput(),
                'first_name'         => new sfWidgetFormInput(),
                'last_name'          => new sfWidgetFormInput(),
                'primary_phone'      => new sfWidgetFormInput(),
                'secondary_phone'    => new sfWidgetFormInput()
             )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'email'         => 'You will use email address for login',
                'secret_answer' => 'This information necessary for password recovery'
            )
        );
        
        $validatorGender = new sfValidatorChoice(
            array('choices' => array_keys($arrayGenders))
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
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 6,
                'max_length' => 20
            ),
            array(
                'min_length' => 'Password must be 6 or more characters',
                'max_length' => 'Password must be 20 or less characters'
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array('required' => true)
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            'equal',
            'confirm_password',
            array(),
            array('invalid' => 'Passwords do not match')
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 255,
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
                'max_length' => 255,
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
               //'gender'           => $validatorGender,
               'email'            => $validatorEmail,
               'first_name'       => $validatorFirstName,
               'last_name'        => $validatorLastName,
               'primary_phone'    => $validatorPrimaryPhone,
               'secondary_phone'  => $validatorSecondaryPhone
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('details[%s]');
        $this->defineSfsListFormatter();
    }
}
