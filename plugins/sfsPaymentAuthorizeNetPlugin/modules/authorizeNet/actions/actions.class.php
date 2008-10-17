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
 * AuthorizeNet actions.
 *
 * @package    plugins.sfsPaymentAuthorizeNetPlugin
 * @subpackage modules.authorizeNet
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class authorizeNetActions extends sfsPaymentActions
{
   /**
    * Gets card info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeIndex($request)
    {
        $this->form = new sfsAuthorizeNetChargeForm();
        
        $cardData = $this->getUser()->getAttribute('card_data', null, 'order/payment/authorizenet');
        
        if ($cardData != null) {
            $this->form->setDefaults($cardData);
        }
        
        if ($request->isMethod('post')) {
            $data = $request->getParameter('data');
            
            $data['card_expire'] = array_merge(array('day' => 1), $data['card_expire']);
            
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                $this->getUser()->setAttribute('card_data', $data, 'order/payment/authorizenet');
                
                if ($request->isXmlHttpRequest()) {
                    return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
                }
                else {
                    $this->redirect('@payment_authorizeNetCharge?order_item_id=' . $request->getParameter('order_item_id'));
                }
            }
            elseif ($request->isXmlHttpRequest()) {
                $errors = array();
                
                foreach ($this->form->getErrorSchema() as $field => $error) {
                    
                    if ($field == 'card_expire') {
                        $errors[$field]['month'] = $error->getMessage();
                    }
                    else {
                        $errors[$field] = $error->getMessage();
                    }
                }
                
                return $this->renderText(sfsJSONPeer::createResponseError($errors));
            }
        }
        else if ($cardData != null) {
            $this->redirect('@payment_authorizeNetCharge?order_item_id=' . $request->getParameter('order_item_id'));
        }
    }
    
   /**
    * Prepare data for charge. Execute charge.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCharge($request)
    {
        sfLoader::loadHelpers(array('sfsCurrency', 'I18N'));
        $this->checkOrderStatus();
        
        $this->errors = array();
        $sfUser = $this->getUser();
        $cardData = $sfUser->getAttribute('card_data', null, 'order/payment/authorizenet');
        $this->cardData = $cardData;
        
        $billingAddress = $sfUser->getAttribute('address', null, 'order/billing');
        $deliveryAddress = $sfUser->getAttribute('address', null, 'order/delivery');
        
        $this->billingAddress  = $billingAddress;
        $this->deliveryAddress = $deliveryAddress;
        $orderItem = $this->getOrderItemObjectByIdOrUuid($request->getParameter('order_item_id'));
        $this->order = $orderItem;
        
        if ($cardData != null) {
            if ($request->isMethod('post')) {
                
                $paymentService = $this->getPaymentServiceObject('authorizenet');
                $params = sfsJSONPeer::decode($paymentService->getParams());
                $total = $orderItem->getTotalPrice();
                
                $options = array(
                    'type' => $params['type'],
                    'test' => $params['is_test_mode']
                );
                
                if ($params['is_test_server']) {
                    $options['url'] = 'https://test.authorize.net/gateway/transact.dll';
                }
                
                $authorizeNet = new sfAuthorizeNet($params['username'], null, $options);
                
                $authorizeNet->setTransactionAmount(format_currency($total, 'USD', true));
                $authorizeNet->setTransactionKey($params['transaction_key']);
                
                //4242424242424242 1209
                
                $authorizeNet->setCardNumber($cardData['card_number']);
                $authorizeNet->setCardSecurityCode($cardData['card_code']);
                $authorizeNet->setCardExpiration($cardData['card_expire']['month'] . $cardData['card_expire']['year']);
                
                $authorizeNet->setBillingFirstName($billingAddress['first_name']);
                $authorizeNet->setBillingLastName($billingAddress['last_name']);
                $authorizeNet->setBillingCompany($billingAddress['company']);
                $authorizeNet->setBillingAddress($billingAddress['street']);
                $authorizeNet->setBillingCity($billingAddress['city']);
                
                $countryIso = CountryPeer::retrieveByPK($billingAddress['country_id'])->getIso();
                $stateTitle = StatePeer::retrieveByPK($billingAddress['state_id'])->getIso();
                
                $authorizeNet->setBillingState($stateTitle);
                $authorizeNet->setBillingCountry($countryIso);
                $authorizeNet->setBillingPostalCode($billingAddress['postcode']);
                
                $authorizeNet->setShippingFirstName($deliveryAddress['first_name']);
                $authorizeNet->setShippingLastName($deliveryAddress['last_name']);
                $authorizeNet->setShippingCompany($deliveryAddress['company']);
                $authorizeNet->setShippingAddress($deliveryAddress['street']);
                $authorizeNet->setShippingCity($deliveryAddress['city']);
                
                $countryIso = CountryPeer::retrieveByPK($deliveryAddress['country_id'])->getIso();
                $stateTitle = StatePeer::retrieveByPK($deliveryAddress['state_id'])->getIso();
                
                $authorizeNet->setShippingState($stateTitle);
                $authorizeNet->setShippingCountry($countryIso);
                $authorizeNet->setShippingPostalCode($deliveryAddress['postcode']);
                
                $result = $authorizeNet->execute();
                
                if (isset($result['success']) && $result['success'] == 1) {
                    $this->setOrderStatusProcessing();
                    $this->redirect('@order_checkoutFinished');
                }
                elseif (!$authorizeNet->isErrorSet()) {
                    $this->logMessage('Payment (AuthorizeNet service): ' . $result['message'], sfLogger::ERR);
                    $this->redirect('@payment_chargeFailed');
                }
                else {
                    $this->errors = $authorizeNet->getErrors();
                    $this->errorType = $authorizeNet->getErrorType();
                }
            }
        }
        else {
            $this->redirect('@payment_authorizeNet?order_item_id=' . $request->getParameter('order_item_id'));
        }
    }
}
