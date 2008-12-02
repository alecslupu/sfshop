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
 * Paypal actions.
 *
 * @package    plugins.sfsPaymentPaypalPlugin
 * @subpackage modules.paypal
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BasePaypalActions extends sfsPaymentActions
{
    public function executeIndex($request)
    {
        $sfUser = $this->getUser();
        
        $orderItem = $this->getOrderItemObjectByIdOrUuid($request->getParameter('order_item_id'));
        $paymentService = $this->getPaymentServiceObject();
        $params = sfsJSONPeer::decode($paymentService->getParams());
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        $cc->setUserName($params['username']);
        $cc->setPassword($params['password']);
        $cc->setSignature($params['signature']);
        $cc->setTestMode($params['test_mode']);
        
        $total = $orderItem->getTotalPrice();
        
        $cc->setTransactionTotal(format_currency($total, 'USD', true));
        $cc->setTransactionDescription('Registration');
        
        $cc->setCancelURL(url_for('@order_paymentSuspend', true));
        $cc->setReturnURL(url_for('@payment_paypalCharge?uuid=' . $orderItem->getUuid(), true));
        
        $goto = $cc->GetExpressUrl();
        
        if ($goto) {
            $this->redirect($goto);
        }
        else {
            $this->logMessage('Payment (Paypal service): ' . $cc->getErrorString(), sfLogger::CRIT);
            $this->redirect('@payment_chargeFailed');
        }
    }
    
    public function executeCharge($request)
    {
        $paymentService = $this->getPaymentServiceObject('paypal');
        $orderItem = $this->getOrderItemObjectByIdOrUuid($request->getParameter('uuid'));
        
        $params = sfsJSONPeer::decode($paymentService->getParams());
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        
        $cc->setUserName($params['username']);
        $cc->setPassword($params['password']);
        $cc->setSignature($params['signature']);
        $cc->setTestMode($params['test_mode']);
        
        $total = $orderItem->getTotalPrice();
        
        $cc->setTransactionTotal(format_currency($total, 'USD', true));
        
        if ($cc->chargeExpressCheckout($request->getParameter('token'))) {
            $this->setOrderStatusProcessing();
            $this->redirect('@order_checkoutFinished');
        }
        else {
            $this->logMessage('Payment (Paypal service): ' . $cc->getErrorString(), sfLogger::CRIT);
            $this->redirect('@payment_chargeFailed');
        }
    }
}
