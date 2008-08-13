<?php
class sfsConfirmEmailForm extends MemberForm
{
    public function configure()
    {
        
        $this->setWidgets(array('confirm_code'  => new sfWidgetFormInput()));
        
        $validatorConfirmCode= new sfValidatorString(
            array('required' => true),
            array('invalid'  => 'Please, input confirm code')
        );
        
        $this->setValidators(array('confirm_code' => $validatorConfirmCode));
        
        parent::configure();
    }
}