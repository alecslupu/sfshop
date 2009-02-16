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
 * Form for edit parameters for Webmoney service.
 *
 * @package    plugin.sfsPaymentWebmoneyPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsWebmoneyParamsForm extends PaymentForm
{
    public function configure()
    {
         $arraySimMode = array(
            '0' => 'All orders successed',
            '1' => 'All orders failed',
            '2' => 'Only 80% orders successed',
        );
        
        $arraySuppordedCurrencise = array('USD', 'RUR', 'UAH', 'EUR');
        
        $this->setWidgets(
            array(
                'sim_mode' => new sfWidgetFormSelect(array('choices' => $arraySimMode)),
            )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'sim_mode' => 'Uses only for test purses'
            )
        );
        
        $validatorSimMode = new sfValidatorChoice(
            array('choices' => array_keys($arraySimMode))
        );
        
        $this->setValidators(
            array(
                'sim_mode' => $validatorSimMode
             )
        );
        
        $criteria = new Criteria();
        CurrencyPeer::addPublicCriteria($criteria);
        $arrayCurrencies = CurrencyPeer::getAll($criteria);
        
        $pursesForm = new sfForm();
        
        foreach ($arrayCurrencies as $currency) {
            
            $code = strtoupper($currency->getCode());
            
            if (in_array($code, $arraySuppordedCurrencise)) {
                $subForm = new sfsWebmoneyPurseParamsForm();
                $pursesForm->embedForm($code, $subForm);
            }
        }
        
        $this->embedForm('webmoney_purses', $pursesForm);
    }
    
    public function setDefault($name, $default)
    { 
        if ($name == 'webmoney_purses') {
            
            $defaults = array();
            
            foreach ($default as $key => $value) {
                $defaults[$key] = $value;
            }
            
            parent::setDefault($name, $defaults);
        }
        else {
            parent::setDefault($name, $default);
        }
    }
}
