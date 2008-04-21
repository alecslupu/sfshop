<?php
class sfsForgotPasswordStepTwoForm extends sfsMemberForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'secret_answer' => new sfWidgetFormInput(),
                'email'         => new sfWidgetFormInputHidden()
            )
        );
        
        $validatorSecretAnswer = new sfValidatorAnd(
            array(
                new sfValidatorString(
                    array('required' => true), 
                    array('invalid' => 'You should input answer on secret question')
                ),
                new sfsValidatorMember(
                    array('check_secret_answer' => true),
                    array('check_secret_answer' => 'The answer is wrong')
                )
            )
        );
        
        $this->setValidators(array('secret_answer' => $validatorSecretAnswer));
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        parent::configure();
    }
}