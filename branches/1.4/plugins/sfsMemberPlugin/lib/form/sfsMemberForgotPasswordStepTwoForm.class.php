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
 * Member forgot password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsMemberForgotPasswordStepTwoForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidgets(
            array(
                'secret_answer' => new sfWidgetFormInput(),
                'email'         => new sfWidgetFormInputHidden()
            )
        );
        
        $validatorSecretAnswer = new sfValidatorString(
            array('required' => true), 
            array('required' => 'Please input an answer on a secret question')
        );
        
        $this->setValidators(array('secret_answer' => $validatorSecretAnswer));
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
        $this->defineSfsListFormatter();
        $this->getWidgetSchema()->setNameFormat('data[%s]');
    }
}