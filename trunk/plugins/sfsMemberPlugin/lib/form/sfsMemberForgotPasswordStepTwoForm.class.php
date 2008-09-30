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
 * Member forgot password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
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
            array('invalid' => 'You should input answer on secret question')
        );
        
        $this->setValidators(array('secret_answer' => $validatorSecretAnswer));
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}