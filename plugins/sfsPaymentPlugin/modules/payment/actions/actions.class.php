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
 * Payment actions.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage modules.payment
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class paymentActions extends sfActions
{
   /**
    * Show all available payment methods with form for choose some.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckout($request)
    {
        sfLoader::loadHelpers(array('Asset', 'Tag', 'I18N'));
        
        $sfUser = $this->getUser();
        
        $deliveryMethodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
        
        if ($deliveryMethodId !== null) {
            $sfUser = $this->getUser();
            
            $defaultMethodId = $sfUser->getAttribute('method_id', null, 'order/payment');
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
                        $logger = $this->getLogger();
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
            
            $this->form = new sfsOrderSelectPaymentForm();
            $this->form->setDefault('method_id', $defaultMethodId);
            
            if ($request->isMethod('post')) {
                $data = $request->getParameter('payment');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    $sfUser->setAttribute('method_id', $data['method_id'], 'order/payment');
                    $this->redirect('@order_checkoutConfirmation');
                }
            }
        }
        else {
            $this->redirect('@delivery_checkout');
        }
    }
    
   /**
    * If some charge is fail, the member will be returned on this page.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeChargeFailed($request)
    {
        return sfView::SUCCESS;
    }
}
