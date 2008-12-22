<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Member registration form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsMemberRegistrationForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('primary_phone');
        $this->offsetUnset('secondary_phone');
        $this->offsetUnset('is_active');
        
        $arrayQuestions = array();
        $questions = MemberSecretQuestionPeer::getAll();
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $this->setWidget('password', new sfWidgetFormInputPassword());
        $this->setWidget('confirm_password', new sfWidgetFormInputPassword());
        $this->setWidget('secret_question', new sfWidgetFormSelect(array('choices' => $arrayQuestions)));
        $this->setWidget('secret_answer', new sfWidgetFormInput());
        
        $this->getWidgetSchema()->setHelps(
            array(
                'email'         => 'You will use email address for login',
                'secret_answer' => 'This information necessary for password recovery',
                'primary_phone' => 'In some urgent cases we\'ll need to contact you quickly and directly.'
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 6,
                'max_length' => 200
            ),
            array(
                'required'   => 'Password is a required field',
                'min_length' => 'Password must be 6 or more characters',
                'max_length' => 'Password can not be more 200 characters'
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array('required' => true),
            array('required' => 'Confirm password is a required field')
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            'equal',
            'confirm_password',
            array(),
            array('invalid' => 'Passwords do not match')
        );
        
        unset($arrayQuestions[0]);
        
        $validatorSecretQuestion = new sfValidatorChoice(
            array('choices'  => array_keys($arrayQuestions)),
            array('invalid'  => 'Please select a secret question')
        );
        
        $validatorSecretAnswer = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2
            ),
            array(
                'required'   => 'Secret answer is a required field',
                'min_length' => 'Secret answer can not be less 2 characters'
            )
        );
        
        $this->setValidator('password', $validatorPassword);
        $this->setValidator('confirm_password', $validatorConfirmPassword);
        $this->setValidator('secret_question', $validatorSecretQuestion);
        $this->setValidator('secret_answer', $validatorSecretAnswer);
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
    }
}