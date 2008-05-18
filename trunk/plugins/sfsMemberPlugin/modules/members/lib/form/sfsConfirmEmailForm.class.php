<?php
class sfsConfirmRegistrationForm extends sfsMemberForm
{
    public function configure()
    {
        
        $this->setWidgets(array('confirm_code'  => new sfWidgetFormInput()));
        
        $validatorConfirmCode= new sfValidatorAnd(
            array(
                new sfValidatorString(
                    array('required' => true),
                    array('invalid'  => 'Please, input confirm code')
                ),
                new sfsValidatorMember(
                    array('check_confirm_code' => true),
                    array('check_confirm_code' => 'Confirm code is wrong')
                )
            )
        );
        
        $this->setValidators(array('confirm_code' => $validatorConfirmCode));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        
        parent::configure();
    }
}