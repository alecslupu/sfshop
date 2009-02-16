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
 * @version    SVN: $Id$
 */
class sfsPaypalParamsForm extends PaymentForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'username'    => new sfWidgetFormInput(array(), array('size' => 40)),
                'password'    => new sfWidgetFormInput(array(), array('size' => 40)),
                'signature'   => new sfWidgetFormInput(array(), array('size' => 70)),
                'test_mode'   => new sfWidgetFormInputCheckbox()
             )
        );
        
        $validatorUsername = new sfValidatorString(
            array('required' => true),
            array('required' => 'Username is a required field')
        );
        
        $validatorPassword = new sfValidatorString(
            array('required' => true),
            array('required' => 'Password is a required field')
        );
        
        $validatorSignature = new sfValidatorString(
            array('required' => true),
            array('required' => 'Signature is a required field')
        );
        
        $this->setValidators(
            array(
                'username'    => $validatorUsername,
                'password'    => $validatorPassword,
                'signature'   => $validatorSignature,
                'test_mode'   => new sfValidatorBoolean()
             )
        );
    }
}
