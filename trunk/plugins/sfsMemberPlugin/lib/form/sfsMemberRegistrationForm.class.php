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
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberRegistrationForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('primary_phone');
        $this->offsetUnset('secondary_phone');
        
        $arrayQuestions = array();
        $questions = MemberSecretQuestionPeer::getAll();
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $this->getWidgetSchema()->offsetSet('password', new sfWidgetFormInputPassword());
        $this->getWidgetSchema()->offsetSet('confirm_password', new sfWidgetFormInputPassword());
        $this->getWidgetSchema()->offsetSet('secret_question', new sfWidgetFormSelect(array('choices' => $arrayQuestions)));
        $this->getWidgetSchema()->offsetSet('secret_answer', new sfWidgetFormInput());
        
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
        
        $this->getValidatorSchema()->offsetSet('password', $validatorPassword);
        $this->getValidatorSchema()->offsetSet('confirm_password', $validatorConfirmPassword);
        $this->getValidatorSchema()->offsetSet('secret_question', $validatorSecretQuestion);
        $this->getValidatorSchema()->offsetSet('secret_answer', $validatorSecretAnswer);
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
    }
}