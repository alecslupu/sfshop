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
 * The form for do request to webmoney service.
 *
 * @package    plugins.sfsPaymentWebmoneyPlugin
 * @subpackage modules.webmoney.lib
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsWebmoneyChargeForm extends sfForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'LMI_PAYMENT_AMOUNT' => new sfWidgetFormInputHidden(),
                'LMI_PAYMENT_DESC'   => new sfWidgetFormInputHidden(),
                'LMI_PAYEE_PURSE'    => new sfWidgetFormInputHidden(),
                'LMI_SIM_MODE'       => new sfWidgetFormInputHidden(),
                'uuid'               => new sfWidgetFormInputHidden(),
                'LMI_SUCCESS_URL'    => new sfWidgetFormInputHidden(),
                'LMI_FAIL_URL'       => new sfWidgetFormInputHidden(),
                'currency_hash'      => new sfWidgetFormInputHidden()
             )
        );
        
        parent::configure();
    }
}