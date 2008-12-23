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
 * Webmoney payment purse form.
 *
 * @package    plugin.sfsPaymentWebmoneyPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsWebmoneyPurseParamsForm extends PaymentForm
{
    public function configure()
    {
        
        $this->setWidgets(array(
            'purse'      => new sfWidgetFormInput(),
            'secret_key' => new sfWidgetFormInput()
        ));
        
        $validatorPurse = new sfValidatorString(
            array('required' => true),
            array('required' => 'Please, enter your purse for currency %currency_title%')
        );
        
        $validatorSecretKey = new sfValidatorString(
            array('required' => true),
            array('required'  => 'Please, enter a secret key for this purse')
        );
        
        $this->setValidators(
            array(
                'purse'      => $validatorPurse,
                'secret_key' => $validatorSecretKey
             )
        );
    }
}
