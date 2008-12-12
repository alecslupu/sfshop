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
 * Member change password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberLoginForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidgets(
            array(
                'email'    => new sfWidgetFormInput(),
                'password' => new sfWidgetFormInputPassword()
             )
        );
        
        $validatorEmail = new sfValidatorEmail(
            array('required' => true),
            array(
                'required' => 'Email is a required field',
                'invalid'  => 'This is not a valid email address'
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array('required' => true),
            array('required' => 'Password is a required field')
        );
        
        $this->setValidators(
            array(
                'email'    => $validatorEmail,
                'password' => $validatorPassword
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
    }
}