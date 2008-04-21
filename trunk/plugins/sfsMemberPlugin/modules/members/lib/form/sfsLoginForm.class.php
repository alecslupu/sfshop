<?php
class sfsLoginForm extends sfsMemberForm
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
                'email'   => new sfValidatorAnd(
                    array(
                        new sfValidatorString(array('required' => true)),
                        new sfsValidatorMember(array('check_login' => true))
                    )
                ),
               'password' => new sfValidatorString(array('required' => true))
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        parent::configure();
    }
}