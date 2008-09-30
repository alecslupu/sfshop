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
        
        parent::configure();
        
        $arrayQuestions = array();
        $criteria = new Criteria();
        MemberSecretQuestionPeer::addPublicCriteria($criteria);
        $questions = MemberSecretQuestionPeer::getAll($criteria);
        
        if ($questions !== null) {
            $arrayQuestions[] = '';
            foreach ($questions as $question) {
                $arrayQuestions[$question->getQuestion()] = $question->getQuestion();
            }
        }
        
        $this->setWidgets(array_merge(
            $this->getWidgets(),
            array(
                'password'           => new sfWidgetFormInputPassword(),
                'confirm_password'   => new sfWidgetFormInputPassword(),
                'secret_question'    => new sfWidgetFormSelect(array('choices' => $arrayQuestions)),
                'secret_answer'      => new sfWidgetFormInput()
             )
        ));
        
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
        
        $this->setValidators(array_merge(
            $this->getValidators(),
            array(
               'email'            => $validatorEmail,
               'password'         => $validatorPassword,
               'confirm_password' => $validatorConfirmPassword,
               'first_name'       => $validatorFirstName,
               'last_name'        => $validatorLastName,
               'secret_question'  => $validatorSecretQuestion,
               'secret_answer'    => $validatorSecretAnswer
            )
        ));
        
        $this->validatorSchema->setPostValidator($validatorComparePasswords);
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
}