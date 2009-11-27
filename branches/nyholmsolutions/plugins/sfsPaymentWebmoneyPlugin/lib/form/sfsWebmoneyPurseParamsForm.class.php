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
 * @version    SVN: $Id$
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
            array('required' => 'Purse is a required field')
        );
        
        $validatorSecretKey = new sfValidatorString(
            array('required' => true),
            array('required'  => 'Secret key is a required field')
        );
        
        $this->setValidators(
            array(
                'purse'      => $validatorPurse,
                'secret_key' => $validatorSecretKey
             )
        );
    }
}
