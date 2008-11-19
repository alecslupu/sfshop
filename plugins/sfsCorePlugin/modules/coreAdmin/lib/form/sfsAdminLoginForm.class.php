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
 * Admin login form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.administratorAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsAdminLoginForm extends AdminForm
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
                'email'     => new sfValidatorString(array('required' => true)),
                'password'  => new sfValidatorString(array('required' => true))
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsAdminListFormatter();
    }
}