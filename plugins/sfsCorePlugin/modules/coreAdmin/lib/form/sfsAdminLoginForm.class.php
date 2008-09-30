<?php
class sfsAdminLoginForm extends AdminForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'username' => new sfWidgetFormInput(),
                'password' => new sfWidgetFormInputPassword()
             )
        );
        
        $this->setValidators(
            array(
                'username' => new sfValidatorString(array('required' => true)),
                'password'  => new sfValidatorString(array('required' => true))
            )
        );
        
        parent::configure();
        
        $this->defineSfsAdminListFormatter();
    }
}