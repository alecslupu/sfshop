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
        
        $billingAddressId = $sfUser->getAttribute('address_id', null, 'order/billing');
        $deliveryAddressId = $sfUser->getAttribute('address_id', null, 'order/delivery');
        
        $this->billingAddress  = AddressBookPeer::retrieveById($billingAddressId);
        $this->deliveryAddress = AddressBookPeer::retrieveById($deliveryAddressId);
        
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
                
                $authorizeNet->setBillingFirstName($this->billingAddress->getFirstName());
                $authorizeNet->setBillingLastName($this->billingAddress->getLastName());
                $authorizeNet->setBillingCompany($this->billingAddress->getCompany());
                $authorizeNet->setBillingAddress($this->billingAddress->getStreet());
                $authorizeNet->setBillingCity($this->billingAddress->getCity());
                
                $countryIso = CountryPeer::retrieveByPK($this->billingAddress->getCountryId())->getIso();
                $stateTitle = StatePeer::retrieveByPK($this->billingAddress->getStateId())->getIso();
                
                $authorizeNet->setBillingState($stateTitle);
                $authorizeNet->setBillingCountry($countryIso);
                $authorizeNet->setBillingPostalCode($this->billingAddress->getPostcode());
                
                $authorizeNet->setShippingFirstName($this->deliveryAddress->getFirstName());
                $authorizeNet->setShippingLastName($this->deliveryAddress->getLastName());
                $authorizeNet->setShippingCompany($this->deliveryAddress->getCompany());
                $authorizeNet->setShippingAddress($this->deliveryAddress->getStreet());
                $authorizeNet->setShippingCity($this->deliveryAddress->getCity());
                
                $countryIso = CountryPeer::retrieveByPK($this->deliveryAddress->getCountryId())->getIso();
                $stateTitle = StatePeer::retrieveByPK($this->deliveryAddress->getStateId())->getIso();
                
                $authorizeNet->setShippingState($stateTitle);
                $authorizeNet->setShippingCountry($countryIso);
                $authorizeNet->setShippingPostalCode($this->deliveryAddress->getPostcode());
                
                $result = $authorizeNet->execute();
                
                $orderItem->setBillingFirstName($this->billingAddress->getFirstName());
                $orderItem->setBillingLastName($this->billingAddress->getLastName());
                $orderItem->setBillingStreet($this->billingAddress->getStreet());
                $orderItem->setBillingCity($this->billingAddress->getCity());
                $orderItem->setBillingCountryId($this->billingAddress->getCountryId());
                $orderItem->setBillingStateId($this->billingAddress->getStateId());
                $orderItem->setBillingStateTitle($this->billingAddress->getStateTitle());
                $orderItem->setBillingPostcode($this->billingAddress->getPostcode());
                
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
