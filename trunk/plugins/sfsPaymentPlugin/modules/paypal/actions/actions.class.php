<?php

/**
 * paypal actions.
 *
 * @package    sfShop
 * @subpackage paypal
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class paypalActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex()
    {
        sfLoader::loadHelpers(array('Url','sfsPayment'));
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        
        $cc->setUserName(sfConfig::get('app_payment_paypal_username'));
        $cc->setPassword(sfConfig::get('app_payment_paypal_password'));
        $cc->setSignature(sfConfig::get('app_payment_paypal_signature'));
        
        $cc->setTestMode(sfConfig::get('app_payment_paypal_test_mode', false));
        
        $orderId = $this->getRequestParameter('order_item_id');
        $order = OrderItemPeer::retrieveById($orderId);
        $this->forward404Unless($order);
        
        if ($order->getStatusId() == OrderStatusPeer::STATUS_PENDING) {
            $total = paypal_total_with_rate($order->getTotalPrice());
            $cc->setTransactionTotal($total);
            $cc->setTransactionDescription('Registration');
            
            $cc->setCancelURL(url_for('@order_paymentSuspend', true));
            $cc->setReturnURL(url_for('@payment_paypalCharged?uuid=' . $order->getUuid() . '&total=' . $total, true));
            
            $goto = $cc->GetExpressUrl();
            
            if ($goto) {
                $this->redirect($goto);
            }
            else {
                $this->message = 'Error: ' . $cc->getErrorString();
            }
        }
        else {
            $this->redirect('@order_checkoutFinished?uuid=' . $order->getUuid());
        }
    }
    
    public function executeCharged()
    {
        sfLoader::loadHelpers(array('sfsPayment'));
        
        $uuid = $this->getRequestParameter('uuid');
        $order = OrderItemPeer::retrieveByUuid($uuid);
        $this->forward404Unless($order);
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        
        $cc->setUserName(sfConfig::get('app_payment_paypal_username'));
        $cc->setPassword(sfConfig::get('app_payment_paypal_password'));
        $cc->setSignature(sfConfig::get('app_payment_paypal_signature'));
        
        $cc->setTestMode(sfConfig::get('app_payment_paypal_test_mode', false));
        
        $total = paypal_total_with_rate($order->getTotalPrice());
        
        $cc->setTransactionTotal($total);
        
        if ($cc->chargeExpressCheckout($this->getRequestParameter('token')))
        {
            $this->redirect('@order_checkoutFinished?uuid=' . $this->getRequestParameter('uuid'));
        }
        else
        {
            $this->message = 'Error: ' . $cc->getErrorString();
        }
    }
}
