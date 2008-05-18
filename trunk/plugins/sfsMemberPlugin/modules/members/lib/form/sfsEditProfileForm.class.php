<?php
class sfsEditProfileForm extends sfsRegistrationForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetUnset('gender');
        $this->getWidgetSchema()->offsetUnset('password');
        $this->getWidgetSchema()->offsetUnset('confirm_password');
        $this->getWidgetSchema()->offsetUnset('secret_question');
        $this->getWidgetSchema()->offsetUnset('secret_answer');
        
        $this->getValidatorSchema()->offsetUnset('gender');
        $this->getValidatorSchema()->offsetUnset('password');
        $this->getValidatorSchema()->offsetUnset('confirm_password');
        $this->getValidatorSchema()->offsetUnset('secret_question');
        $this->getValidatorSchema()->offsetUnset('secret_answer');
        
    }
}