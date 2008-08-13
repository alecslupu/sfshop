<?php
class sfsLoginForm extends MemberForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'email'    => new sfWidgetFormInput(),
                'password' => new sfWidgetFormInputPassword()
             )
        );
        
        $this->setValidators(
            array(
                'email'    => new sfValidatorEmail(array('required' => true)),
                'password' => new sfValidatorString(array('required' => true))
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        parent::configure();
    }
}