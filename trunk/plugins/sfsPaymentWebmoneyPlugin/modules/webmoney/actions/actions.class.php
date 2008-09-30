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
 * webmoney actions.
 *
 * @package    plugins.sfsPaymentWebmoneyPlugin
 * @subpackage modules.webmoney
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class webmoneyActions extends sfsPaymentActions
{
    protected $orderItem = null;
    
   /**
    * Prepare data for charge and go to webmoney service.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeIndex($request)
    {
        sfLoader::loadHelpers(array('sfsCurrency', 'I18N'));
        
        $orderItem = $this->getOrderItemObjectByIdOrUuid($this->getRequestParameter('order_item_id'));
        $paymentService = $this->getPaymentServiceObject('webmoney');
        
        $params = sfsJSONPeer::decode($paymentService->getParams());
        $total = $orderItem->getTotalPrice();
        
        $currencyCode = $this->getUser()->getBasket()->getCurrency()->getCode();
        
        $purse = $params['webmoney_purses'][$currencyCode];
        $hashCurrencyCode = md5($currencyCode . $purse['secret_key']);
        
        $description = __('Products') . ': ';
        
        $i = 0;
        
        foreach ($orderItem->getOrderProductsJoinProduct() as $itemProduct) {
            $description .= $itemProduct->getProduct()->getTitle();
            
            if (count($orderItem->getOrderProductsJoinProduct()) - 1 > $i) {
                $description.=', ';
            }
            
            $i++;
        }
        
        if (mb_strlen($description, 'utf-8') > 250) {
            $description = mb_substr($description, 0, 240, 'utf-8') . ' ...';
        }
        
        $this->form = new sfsWebmoneyChargeForm();
        $this->form->setDefaults(
            array(
                'LMI_PAYEE_PURSE'    => $purse['purse'],
                'LMI_PAYMENT_AMOUNT' => format_currency($total, null, true),
                'LMI_PAYMENT_DESC'   => $description,
                'LMI_SIM_MODE'       => $params['sim_mode'],
                'uuid'               => $orderItem->getUuid(),
                'LMI_SUCCESS_URL'    => url_for('@payment_webmoneyCharged', true),
                'LMI_FAIL_URL'       => url_for('@payment_webmoneyChargeFailed', true),
                'currency_hash'      => $hashCurrencyCode
            )
        );
        
        $this->setLayout('layoutEmpty');
    }
    
   /**
    * Check charge parameters.
    * 
    * The webmoney service is call this action for check charge parameters of payment. If some parameter is wrong, 
    * the member will receive an error on the webmoney charge page.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckCharge($request)
    {
        sfLoader::loadHelpers(array('sfsCurrency', 'I18N'));
        $service = $this->getPaymentServiceObject('webmoney');
        $params = sfsJSONPeer::decode($service->getParams());
        
        if ($request->hasParameter('currency_hash')) {
            $isCurrencyCorrect = false;
            $purses = $params['webmoney_purses'];
            
            foreach ($purses as $currencyCode => $p) {
                $hashCurrencyCode = md5($currencyCode . $p['secret_key']);
                
                if ($hashCurrencyCode == $request->getParameter('currency_hash')) {
                    $isCurrencyCorrect = true;
                    $purse = $p['purse'];
                    $secretKey = $p['secret_key'];
                    break;
                }
            }
        }
        
        if ($request->hasParameter('LMI_PREREQUEST')) {
            $orderItem = OrderItemPeer::retrieveByUuid($request->getParameter('uuid'));
            
            if ($orderItem == null) {
                $error = __('Error: order does not exists.');
            }
            else {
                
                $amount = format_currency($orderItem->getTotalPrice(), $currencyCode, true);
                
                if (!$isCurrencyCorrect) {
                    $error = __('Error: wrong currency hash.');
                }
                else if ($request->getParameter('LMI_PAYMENT_AMOUNT') !== $amount) {
                    $error = __('Error: wrong amount.');
                }
                elseif($request->getParameter('LMI_PAYEE_PURSE') !== $purse) {
                    $error = __('Error: wrong purse');
                }
                else {
                    $this->renderText('YES');
                }
            }
            
            if (isset($error)) {
                $this->renderText($error);
                $this->logMessage('Payment (Webmoney service): ' . $error, sfLogger::ERR);
            }
        }
        else if ($request->hasParameter('LMI_HASH')) {
            $str = $request->getParameter('LMI_PAYEE_PURSE')
                . $request->getParameter('LMI_PAYMENT_AMOUNT')
                . $request->getParameter('LMI_PAYMENT_NO')
                . $request->getParameter('LMI_MODE')
                . $request->getParameter('LMI_SYS_INVS_NO')
                . $request->getParameter('LMI_SYS_TRANS_NO')
                . $request->getParameter('LMI_SYS_TRANS_DATE')
                . $secretKey
                . $request->getParameter('LMI_PAYER_PURSE')
                . $request->getParameter('LMI_PAYER_WM');
            $hash = strtoupper(md5($str));
            
            if ($hash == $request->getParameter('LMI_HASH')) {
                $this->setOrderStatusProcessing();
            }
            else {
                $this->logMessage('Payment (Webmoney service): the hash of payment is wrong.', sfLogger::ERR);
            }
        }
        else {
            $this->logMessage('Payment (Webmoney service): the request is failed.', sfLogger::ERR);
        }
        
        return sfView::NONE;
    }
    
   /**
    * Success charge action.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCharged($request)
    {
        $this->redirect('@order_checkoutFinished');
    }
    
   /**
    * Faile charge action.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeChargeFailed($request)
    {
        $this->logMessage('Payment (Webmoney service): The charge is failed.', sfLogger::ERR);
        $this->redirect('@payment_chargeFailed');
    }
}
