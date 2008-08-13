<?php
class sfsChangePasswordForm extends MemberForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'current_password' => new sfWidgetFormInputPassword(),
                'password'         => new sfWidgetFormInputPassword(),
                'confirm_password' => new sfWidgetFormInputPassword(),
             )
        );
        
        $validatorCurrentPassword = new sfsValidatorMember(
            array(
                'required'   => true, 
                'check_password' => true, 
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 6 , 
                'max_length' => 20
            ),
            array(
                'min_length' => 'Password must be 6 or more characters',
                'max_length' => 'Password must be 20 or less characters'
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 6 ,
                'max_length' => 20
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
               'current_password' => $validatorCurrentPassword,
               'password'         => $validatorPassword,
               'confirm_password' => $validatorConfirmPassword,
            )
        );
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->getWidgetSchema()->setNameFormat('change_password[%s]');
        parent::configure();
    }
}