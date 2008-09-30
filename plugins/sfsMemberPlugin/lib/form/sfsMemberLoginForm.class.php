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
 * Member change password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberLoginForm extends MemberForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'email'    => new sfWidgetFormInput(),
                'password' => new sfWidgetFormInputPassword()
             )
        );
        
        $this->setValidators(
            array(
                'email'    => new sfValidatorEmail(array('required' => true)),
                'password' => new sfValidatorString(array('required' => true))
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        parent::configure();
    }
}