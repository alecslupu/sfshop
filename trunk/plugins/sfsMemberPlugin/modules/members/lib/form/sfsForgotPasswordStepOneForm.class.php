<?php
class sfsForgotPasswordStepOneForm extends sfsMemberForm
{
    public function configure()
    {
        
        $this->setWidgets(array('email' => new sfWidgetFormInput()));
        
        $validatorEmail = new sfValidatorAnd(
            array(
                new sfValidatorEmail(
                    array('required' => true), 
                    array('invalid' => 'This is not a valid email address')
                ),
                new sfsValidatorMember(
                    array('check_exist_account' => true),
                    array('check_exist_account' => 'An account with this email does not exists')
                )
            )
        );
        
        $this->setValidators(array('email' => $validatorEmail));
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}