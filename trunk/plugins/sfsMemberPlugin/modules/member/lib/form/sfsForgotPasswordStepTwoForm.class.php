<?php
class sfsForgotPasswordStepTwoForm extends MemberForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'secret_answer' => new sfWidgetFormInput(),
                'email'         => new sfWidgetFormInputHidden()
            )
        );
        
        $validatorSecretAnswer = new sfValidatorString(
            array('required' => true), 
            array('invalid' => 'You should input answer on secret question')
        );
        
        $this->setValidators(array('secret_answer' => $validatorSecretAnswer));
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
        parent::configure();
    }
}