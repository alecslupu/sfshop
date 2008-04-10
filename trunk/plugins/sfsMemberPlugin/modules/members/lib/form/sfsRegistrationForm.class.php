<?php
class sfsRegistrationForm extends sfsMemberForm
{
    public function configure()
    {
        $arrayQuestions = array();
        $questions = sfsMemberSecretQuestionsPeer::getAllQuestionsWithI18n();
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $arrayGenders = array(
            'male'   => __('Male'),
            'female' => __('Female')
        );
        
        $this->setWidgets(
            array(
                'gender'             => new sfWidgetFormSelect(array('choices' => $arrayGenders)),
                'email'              => new sfWidgetFormInput(),
                'first_name'         => new sfWidgetFormInput(),
                'last_name'          => new sfWidgetFormInput(),
                'phone'              => new sfWidgetFormInput(),
                'mobile_phone'       => new sfWidgetFormInput(),
                'password'           => new sfWidgetFormInputPassword(),
                'confirm_password'   => new sfWidgetFormInputPassword(),
                'secret_question'    => new sfWidgetFormSelect(array('choices' => $arrayQuestions)),
                'secret_answer'      => new sfWidgetFormInput()
             )
        );
        
        $validatorGender = new sfValidatorChoice(
            array('choices' => $arrayGenders)
        );
        
        $validatorEmail = new sfValidatorAnd(
            array(
                new sfValidatorEmail(
                    array('required' => true), 
                    array('invalid' => __('This is not a valid email address'))
                ),
                new sfsValidatorMember(
                    array('check_email' => true),
                    array('check_email' => __('An account with this email already exists'))
                )
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 6 , 
                'max_length' => 20
            ),
            array(
                'min_length' => __('Password must be 6 or more characters'),
                'max_length' => __('Password must be 20 or less characters')
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array('required'   => true)
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            'equal',
            'confirm_password',
            array(),
            array('invalid'  => 'Passwords do not match')
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            )
        );
        
        $validatorSecretQuestion = new sfValidatorChoice(
            array('choices' => $arrayQuestions)
        );
        
        $validatorSecretAnswer = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            )
        );
        
        $this->setValidators(
            array(
               //'gender'           => $validatorGender,
               'email'            => $validatorEmail,
               'password'         => $validatorPassword,
               'confirm_password' => $validatorConfirmPassword,
               'first_name'       => $validatorFirstName,
               'last_name'        => $validatorLastName,
               'secret_question'  => $validatorSecretQuestion,
               'secret_answer'    => $validatorSecretAnswer
            )
        );
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}