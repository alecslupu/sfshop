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
 * Form for edit parameters for AuthorizeNet service.
 *
 * @package    plugin.sfsPaymentAuthorizeNetPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsAuthorizeNetParamsForm extends PaymentForm
{
    public function configure()
    {
        $arrayType = array(
            'AUTH_CAPTURE' => 'Auth capture',
            'AUTH_ONLY'    => 'Auth only'
        );
        
        $arrayServers = array(
            'test'        => 'test',
            'production'  => 'production'
        );
        
        $this->setWidgets(
            array(
                'username'        => new sfWidgetFormInput(),
                'transaction_key' => new sfWidgetFormInput(),
                'type'            => new sfWidgetFormSelect(array('choices' => $arrayType)),
                'is_test_mode'    => new sfWidgetFormInputCheckbox(),
                'is_test_server'  => new sfWidgetFormInputCheckbox()
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
        
        $validatorTransactionKey = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'You should input transaction key'
            )
        );
        
        $validatorType = new sfValidatorChoice(
            array('choices' => array_keys($arrayType))
        );
        
        $this->setValidators(
            array(
                'username'        => $validatorUsername,
                'transaction_key' => $validatorTransactionKey,
                'type'            => $validatorType
            )
        );
        
        $this->defineSfsAdminListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
