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
 * Form for edit parameters for Paypal service.
 *
 * @package    plugin.sfsPaymentPaypalPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsPaypalParamsForm extends PaymentForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'username'    => new sfWidgetFormInput(),
                'password'    => new sfWidgetFormInput(),
                'signature'   => new sfWidgetFormInput(),
                'test_mode'   => new sfWidgetFormInputCheckbox()
             )
        );
        
        $validatorUsername = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'You should input username'
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'You should input password'
            )
        );
        
        $validatorSignature = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'You should input signature'
            )
        );
        
        $this->setValidators(
            array(
                'username'    => $validatorUsername,
                'password'    => $validatorPassword,
                'signature'   => $validatorSignature
             )
        );
        
        $this->defineSfsAdminListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
