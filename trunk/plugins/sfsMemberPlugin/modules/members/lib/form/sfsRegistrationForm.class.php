<?php
class sfsRegistrationForm extends sfsMemberForm
{
    public function configure()
    {
        $arrayQuestions = array();
        $questions = sfsMemberSecretQuestionsPeer::getAllAvaliable();
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $arrayGenders = sfsMemberPeer::getGenders();
        
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
                    array('invalid' => 'This is not a valid email address')
                ),
                new sfsValidatorMember(
                    array('check_unique_email' => true),
                    array('check_unique_email' => 'An account with this email already exists')
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
                'min_length' => 'Password must be 6 or more characters',
                'max_length' => 'Password must be 20 or less characters'
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
            ),
            array(
                'min_length' => 'First name can not be less 4 characters',
                'max_length' => 'First name number can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            ),
            array(
                'min_length' => 'Last name can not be less 4 characters',
                'max_length' => 'Last name can not be more 255 characters',
            )
        );
        
        $validatorPhone = new sfValidatorAnd(
            array(
                new sfValidatorRegex(
                    array(
                        'required' => false,
                        'pattern'  => '/^[0-9()]{1,}$/i'
                    ),
                    array('invalid'  => 'Phone number must contain only numerals and "()" symbols')
                ),
                new sfValidatorString(
                    array(
                        'required'   => false,
                        'min_length' => 4
                    ),
                    array(
                        'min_length' => 'Phone number can not be less 4 numerals'
                    )
                )
            ),
            array('required' => false)
        );
        
        $validatorMobilePhone = new sfValidatorAnd(
            array(
                new sfValidatorRegex(
                    array(
                        'required' => false,
                        'pattern'  => '/^[0-9()]{1,}$/i'
                    ),
                    array('invalid'  => 'Mobile phone number must contain only numerals and "()" symbols')
                ),
                new sfValidatorString(
                    array(
                        'min_length' => 11,
                        'max_length' => 15
                    ),
                    array(
                        'min_length' => 'Mobile phone number can not be less 11 characters',
                        'max_length' => 'Mobile phone number can not be more 15 characters',
                    )
                )
            ),
            array('required' => false)
        );
        
        $validatorSecretQuestion = new sfValidatorChoice(
            array('choices' => $arrayQuestions),
            array('invalid' => 'Please select secret question')
        );
        
        $validatorSecretAnswer = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            )
        );
        
        $this->setValidators(
            array(
               'gender'           => $validatorGender,
               'email'            => $validatorEmail,
               'password'         => $validatorPassword,
               'confirm_password' => $validatorConfirmPassword,
               'first_name'       => $validatorFirstName,
               'last_name'        => $validatorLastName,
               'phone'            => $validatorPhone,
               'mobile_phone'     => $validatorMobilePhone,
               'secret_question'  => $validatorSecretQuestion,
               'secret_answer'    => $validatorSecretAnswer
            )
        );
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->getWidgetSchema()->setNameFormat('details[%s]');
        
        parent::configure();
    }
}