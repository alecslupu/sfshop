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
 * cmcic actions.
 *
 * @package    plugins.sfsPaymentCMCICPlugin
 * @subpackage modules.cmcic
 * @author     Olivier Revollat <revollat@gmail.com>
 */
class BaseCmcicActions extends sfsPaymentActions
{
    protected $orderItem = null;
    
   /**
    * Prepare data for charge and go to cmcic service.
    *
    * @param  void
    * @return void
    * @author Olivier Revollat <revollat@gmail.com>
    * @access public
    */
    public function executeIndex($request)
    {
        sfLoader::loadHelpers(array('sfsCurrency', 'I18N'));
        
        $orderItem = $this->getOrderItemObjectByIdOrUuid($this->getRequestParameter('order_item_id'));
        //$paymentService = $this->getPaymentServiceObject('cmcic');
        //$params = sfsJSONPeer::decode($paymentService->getParams());
        $currencyCode = $this->getUser()->getBasket()->getCurrency()->getCode();
				
        $cmcic_payment = new sfPaymentCIC();
        $cmcic_payment->setLanguage(strtoupper($this->getUser()->getCulture())); 			// Language code 'FR, 'EN', ...
        $cmcic_payment->setCurrency($currencyCode); 										// Currency code 'EUR'
        $cmcic_payment->setAmount($orderItem->getTotalPrice());								// Order amount
        $cmcic_payment->setOrderReference($orderItem->getId()); // $orderItem->getUuid()	// Order reference
        
        $this->form = new sfsCmcicChargeForm(); // Form to be post to the CM-CIC online payment website

        $this->form->setDefaults(
            array(
				'version'			=> sfPaymentCIC::CMCIC_VERSION,
				'TPE'				=> $cmcic_payment->getTPEData('number'),
				'date'				=> sfPaymentCIC::HtmlEncode($cmcic_payment->getOrderDate()),
				'montant'			=> $cmcic_payment->getAmount() . $currencyCode,
				'reference'			=> $cmcic_payment->getOrderReference(),
				'MAC'				=> $cmcic_payment->getKeyedMAC(),
				'url_retour'		=> sfPaymentCIC::HtmlEncode(url_for('@order_paymentSuspend', true)),
				'url_retour_ok'		=> sfPaymentCIC::HtmlEncode(url_for('@payment_cmcicCharged', true)),
				'url_retour_err'	=> sfPaymentCIC::HtmlEncode(url_for('@payment_cmcicChargeFailed', true)),
				'lgue'				=> strtoupper($this->getUser()->getCulture()),
				'societe'			=> $cmcic_payment->getTPEData('company'),
				'texte-libre'		=> ''
            )
        );
                
        $this->setLayout('layoutEmpty');
    }
    
   /**
    * Check charge.
    * 
    * @param  void
    * @return void
    * @author Olivier Revollat <revollat@gmail.com>
    * @access public
    */
    public function executeCheckCharge($request)
    {		
    	$this->payment = new sfPaymentCIC();
		$this->bank_response = $this->payment->checkResponse();
		$isValid = ($this->bank_response['accuseReception'] == sfPaymentCIC::CMCIC_PHP2_MACOK);
		
		$code_retour_accepted = constant('sfPaymentCIC::CODE_RETOUR_ACCEPTED_'.sfConfig::get('sf_environment', 'prod'));
		$code_retour_denied = constant('sfPaymentCIC::CODE_RETOUR_DENIED_'.sfConfig::get('sf_environment', 'prod'));
		
		$orderItem = OrderItemPeer::retrieveById($this->bank_response['reference']);
						
		switch($this->bank_response['code-retour']){
			case $code_retour_accepted:
				$this->setOrderStatusProcessing($orderItem->getUuid());
				break;
			case $code_retour_denied:
				break;
		}

    	$response = $this->getResponse();
  		$response->clearHttpHeaders();
  		$response->setContent(sprintf(sfPaymentCIC::CMCIC_PHP2_RECEIPT, $this->bank_response['accuseReception']));
  		$response->sendContent();
  		return sfView::NONE;
    }
    
   /**
    * Success charge action.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCharged($request)
    {
        $this->redirect('@order_checkoutFinished');
    }
    
   /**
    * Failed charge action.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeChargeFailed($request)
    {
        $this->redirect('@payment_chargeFailed');
    }
}
