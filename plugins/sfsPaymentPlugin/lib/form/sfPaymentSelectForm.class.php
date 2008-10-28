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
 * sfsPaymentSelect form.
 *
 * @package    plugin.sfsPaymentPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsPaymentSelectForm extends BasePaymentForm
{
    protected $paymentServices = null;
    
    public function configure()
    {
        $sfUser = sfContext::getInstance()->getUser();
        
        $currencyCode = $sfUser->getBasket()->getCurrency()->getCode();
        
        $criteria = new Criteria();
        PaymentPeer::addPublicCriteria($criteria);
        $this->paymentServices = PaymentPeer::getAll($criteria);
        
        foreach ($this->paymentServices as $key => $paymentService) {
            $acceptCurrenciesCodes = $paymentService->getAcceptCurrenciesCodes();
            $arrayAcceptCurrenciesCodes = explode(',', $acceptCurrenciesCodes);
            
            if ($acceptCurrenciesCodes != '*' && !in_array($currencyCode, $arrayAcceptCurrenciesCodes)) {
                $criteria = new Criteria();
                CurrencyPeer::addPublicCriteria($criteria);
                $isExist = CurrencyPeer::checkExistenceByCodes($arrayAcceptCurrenciesCodes, $criteria);
            }
            else {
                $isExist = true;
            }
            
            if (!$isExist) {
                 if (sfConfig::get('sf_logging_enabled')) {
                    $logger = sfContext::getInstance()->getLogger();
                    $logger->err('Payment checkout: The service "' . $paymentService->getTitle() . '" can not be used on your store, '
                        . 'because the currencies which accept this service is not available. '
                        . 'Now this service has status inactive for change status you should add currency which accept this service '
                        . 'and than you may set status active in the section payment of admin panel '
                        . 'This service is accept following currencies: ' . str_replace(',', ', ', $acceptCurrenciesCodes));
                }
                
                $paymentService->setIsActive(false);
                $paymentService->save();
                
                unset($this->paymentServices[$key]);
            }
        }
        
        $choices = array();
        foreach ($this->paymentServices as $paymentService) {
            $choices[$paymentService->getId()] = $paymentService->getTitle();
        }
        
        $this->setWidgets(
            array('method_id' => new sfWidgetFormSelectRadio(
                array(
                    'choices'  => $choices, 
                    'formatter'=> array('PaymentForm','radioFormatter')
                )
            ))
        );
        
        $this->widgetSchema->setLabel('method_id', 'Methods');
        
        $validatorMethodId = new sfValidatorChoice(
            array('choices' => array_keys($choices)),
            array('required' => 'Please select a some payment method')
        );
        
        $this->setValidators(array('method_id' => $validatorMethodId));
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
    }
    
    public function getPaymentServices()
    {
        return $this->paymentServices;
    }
}
