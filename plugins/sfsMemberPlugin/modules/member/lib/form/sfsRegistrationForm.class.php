<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Member registration form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage modules.member.lib
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsRegistrationForm extends MemberForm
{
    public function configure()
    {
        $arrayQuestions = array();
        $questions = MemberSecretQuestionPeer::getAllAvaliable();
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $arrayGenders = MemberPeer::getGenders();
        
        $this->setWidgets(
            array(
                //'gender'             => new sfWidgetFormSelect(array('choices' => $arrayGenders)),
                'email'              => new sfWidgetFormInput(),
                'first_name'         => new sfWidgetFormInput(),
                'last_name'          => new sfWidgetFormInput(),
                'password'           => new sfWidgetFormInputPassword(),
                'confirm_password'   => new sfWidgetFormInputPassword(),
                'secret_question'    => new sfWidgetFormSelect(array('choices' => $arrayQuestions)),
                'secret_answer'      => new sfWidgetFormInput()
             )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'email' => 'You will use email address for login',
            )
        );
        
        $validatorGender = new sfValidatorChoice(
            array('choices' => array_keys($arrayGenders))
        );
        
        $validatorEmail = new sfValidatorAnd(
            array(
                new sfValidatorEmail(
                    array('required' => true),
                    array('invalid'  => 'This is not a valid email address')
                ),
                new sfsValidatorMember(
                    array('check_unique_email' => true),
                    array('check_unique_email' => 'An account with this email already exists')
                )
            ),
            array('required' => true),
            array('required' => 'Please enter a valid email address')
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 6,
                'max_length' => 20
            ),
            array(
                'min_length' => 'Password must be 6 or more characters',
                'max_length' => 'Password must be 20 or less characters'
            )
        );
        
        $validatorConfirmPassword = new sfValidatorString(
            array('required' => true)
        );
        
        $validatorComparePasswords = new sfValidatorSchemaCompare(
            'password', 
            'equal',
            'confirm_password',
            array(),
            array('invalid' => 'Passwords do not match')
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 255,
            ),
            array(
                'required'   => 'First Name is a required field',
                'min_length' => 'First Name can not be less 2 characters',
                'max_length' => 'First Name can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 2,
                'max_length' => 255,
            ),
            array(
                'required'   => 'Last Name is a required field',
                'min_length' => 'Last Name can not be less 2 characters',
                'max_length' => 'Last Name can not be more 255 characters',
            )
        );
        
        $validatorSecretQuestion = new sfValidatorChoice(
            array('choices' => array_keys($arrayQuestions)),
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
        $this->getWidgetSchema()->setNameFormat('details[%s]');
        
        parent::configure();
    }
}