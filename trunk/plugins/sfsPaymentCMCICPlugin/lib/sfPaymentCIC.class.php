<?php
/*
 * This file is part of the sfPaymentCIC package.
 * 
 * (c) 2009 Olivier Revollat <revollat@gmail.com>
 * (c) 2008 Christophe Buguet <christophe@codingstyle.fr>
 * (c) 2003 Euro-Information. All rights reserved.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This class contains all the logic for creating the request form for a standard P@aiement CIC
 * payment.
 *
 * @author Olivier Revollat <revollat@gmail.com> 
 * @author Christophe Buguet (christophe@codingstyle.fr)
 * @author Euro-Information (centrecom@e-i.com)
 */
class sfPaymentCIC
{
	// CIC constants
	const CMCIC_CTLHMAC 		= 'V1.03.sha1.php4--CtlHmac-%s-[%s]-%s';
	const CMCIC_VERSION 		= '1.2open';
	const CMCIC_PHP2_RECEIPT 	= 'Pragma: no-cache \nContent-type: text/plain \nVersion: 1 %s';
	const CMCIC_PHP2_MACOK 		= 'OK';
	const CMCIC_PHP2_MACNOTOK 	= 'Document Falsifie 0--';
	const CMCIC_PHP2_FIELDS 	= '%s%s+%s+%s+%s+%s+%s+%s+';
	const CMCIC_PHP1_FIELDS 	= '%s%s*%s*%s%s*%s*%s*%s*%s*%s*';  
	
	// Payment parameters
	private $tpe 				= array();
	private $passPhrase 		= '';
	private $serverUrl 			= '';
	private $returnUrl 			= '';
	
	// Symfony internal
	private $context;
	
	// User payment information
	private $orderDate			= null;
	private $amount;
	private $currency;
	private $orderReference;
	private $orderComment;
	private $language;
	private $merchantCode;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->serverUrl = sfConfig::get('app_cic_payment_request_url');
		//$this->returnUrl = sfConfig::get('app_cic_payment_return_url');
		$this->passPhrase = sfConfig::get('app_cic_payment_passphrase');
		$this->context = sfContext::getInstance();

		$this->tpe = sfConfig::get('app_cic_payment_tpe');
		
		if ($this->tpe['company'] == '') {
			throw new Exception('Missing TPE company name : ' . $this->tpe['company']);
		}		
		if ($this->tpe['number'] == '') {
			throw new Exception('Missing TPE number : ' . $this->tpe['number']);
		}
		if ($this->tpe['key'] == '') {
			throw new Exception('Missing TPE key : ' . $this->tpe['key']);
		}		
		
	}
	
	
	/**
	 * Returns the bank server URL
	 * @return A string containing the full URL
	 */
	public function getServerURL()
	{
		return $this->serverUrl;
	}

	
	/**
	 * Returns if it exists, a key from TPE configuration
	 * @param $key The element in TPE configuration
	 */
	public function getTPEData($key)
	{
		if (array_key_exists($key, $this->tpe)) {
			return $this->tpe[$key];
		}
		
		return null;
	}
		
	
	/**
	 * Returns the order date
	 * @return A string containing the date and time
	 */
	public function getOrderDate()
	{
		if ($this->orderDate == null) {
			$this->orderDate = date('d/m/Y:H:i:s');
		}
		
		return $this->orderDate;
	}
	

	/**
	 * Sets the order date
	 * @param $date The date and time of order
	 */
	public function setOrderDate($date)
	{
		$this->orderDate = $date; 
	}	
	
	
	/**
	 * Returns the order amount
	 * @return The amount (ex: 124.10)
	 */
	public function getAmount()
	{
		return $this->amount; 
	}
	
	
	/**
	 * Sets the amount of the order
	 * @param $amount The amount (ex: 124.10)
	 */
	public function setAmount($amount)
	{
		if (!is_numeric($amount)) {
			throw new Exception('Invalid amount : ' . $amount);	
		}
		
		$this->amount = $amount;
	}
	
	
	/**
	 * Sets the currency
	 * @param $currency The currency
	 */
	public function setCurrency($currency)
	{
		if (!in_array($currency, sfConfig::get('app_cic_payment_currencies'))) {
			throw new Exception('Invalid currency : ' . $currency);	
		}
		
		$this->currency = $currency;
	}	
	
	/**
	 * Returns the currency used for payment
	 * @return A string containing the currency
	 */
	public function getCurrency()
	{
		$currencies = sfConfig::get('app_cic_payment_currencies');
		
		if ($this->currency == '') {
			return strtoupper($currencies[0]);
		}
		
		return strtoupper($this->currency);
	}		
	
	
	/**
	 * Sets the order reference (can be the ID from a table for example)
	 * @param $orderReference The user reference
	 */
	public function setOrderReference($orderReference)
	{
		$this->orderReference = $orderReference; 
	}
	
	
	/**
	 * Returns the order reference passed by user
	 * @return A string containing the reference
	 */
	public function getOrderReference()
	{
		return $this->orderReference; 
	}	
		
	
	/**
	 * Sets the order comment
	 * @param $orderComment The comment
	 */
	public function setOrderComment($orderComment)
	{
		$this->orderComment = $orderComment; 
	}
	
	
	/**
	 * Returns the order comment
	 * @return A string containing the comment
	 */
	public function getOrderComment()
	{
		return $this->orderComment; 
	}	
	
	
	/**
	 * Sets the language for the payment form
	 * @param $language The language (2 chars)
	 */
	public function setLanguage($language)
	{
		$this->language = $language; 
	}	

	/**
	 * Returns the language set
	 * @return The language set by the user
	 */
	public function getLanguage()
	{
		return $this->language; 
	}	
	
	
	/**
	 * Generates and returns the keyed MAC for the payment form request
	 * @return The keyed-hashed message
	 */
	public function getKeyedMAC()
	{
	    $fields = sprintf(sfPaymentCIC::CMCIC_PHP1_FIELDS, 
	    									'',
                                            $this->tpe['number'],
                                            $this->getOrderDate(),
                                            $this->getAmount(),
                                            $this->getCurrency(),
                                            $this->getOrderReference(),
                                            $this->getOrderComment(),
                                            sfPaymentCIC::CMCIC_VERSION,
                                            $this->getLanguage(),
                                            $this->tpe['company']);

    	//print_r($fields);
        return $this->CMCIC_Hmac($fields);
	}
	
	/**
	 * Renvoie un paramètre GET ou POST
	 * @param $param Le paramètre de la requête
	 * @return La valeur associée 
	 */
	private function getRequestParameter($param)
	{
		return $this->context->getRequest()->getParameter($param, '');
	}
	
	
	/**
	 * Performs MAC verification and creates the receipt for the bank's request
	 * @return An array containing receipt information
	 */
	public function checkResponse()
	{
	   @$php2_fields = sprintf(sfPaymentCIC::CMCIC_PHP2_FIELDS, 
	   											  $this->getRequestParameter('retourPLUS'), 
	                                              $this->tpe['number'], 
	                                              $this->getRequestParameter('date'),
	                                              $this->getRequestParameter('montant'),
	                                              $this->getRequestParameter('reference'),
	                                              $this->getRequestParameter('texte-libre'),
	                                              sfPaymentCIC::CMCIC_VERSION,
	                                              $this->getRequestParameter('code-retour'));
	
	    if (strtolower($this->getRequestParameter('MAC')) == $this->CMCIC_hmac($php2_fields)):
	        $result  = $this->getRequestParameter('code-retour') . $this->getRequestParameter('retourPLUS');
	        $receipt = sfPaymentCIC::CMCIC_PHP2_MACOK;
	    else: 
	        $result  = 'None';
	        $receipt = sfPaymentCIC::CMCIC_PHP2_MACNOTOK . $php2_fields;
	    endif;
	
	    $mnt_lth = strlen($this->getRequestParameter('montant')) - 3;
	    if ($mnt_lth > 0):
	        $currency = substr($this->getRequestParameter('montant'), $mnt_lth, 3);
	        $amount   = substr($this->getRequestParameter('montant'), 0, $mnt_lth);
	    else:
	        $currency = "";
	        $amount   = $this->getRequestParameter('montant');
	    endif;
	    
	    $this->orderReference = $this->getRequestParameter('reference');
	    $this->amount = $amount;
	    $this->currency = $currency;
	
	    return array( 'resultatVerifie' => $result ,
	                  'accuseReception' => $receipt ,
	                  'tpe'             => $this->getRequestParameter('TPE'),
	                  'reference'       => $this->getRequestParameter('reference'),
	                  'texteLibre'      => $this->getRequestParameter('texte-libre'),
	                  'devise'          => $currency,
	                  'montant'         => $amount);
	}	
	
	
	/**
	 * Encode special characters under HTML format
	 * @param $data String to encode
	 * @return Encoded string
	 */ 
	public static function HtmlEncode ($data)
	{
	    $SAFE_OUT_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890._-';
	    $encoded_data = '';
	    $result = '';
	    for ($i = 0; $i < strlen($data); $i++)
	    {
	        if (strchr($SAFE_OUT_CHARS, $data{$i})) {
	            $result .= $data{$i};
	        }
	        else if (($var = bin2hex(substr($data, $i, 1))) <= '7F'){
	            $result .= '&#x' . $var . ';';
	        }
	        else
	            $result .= $data{$i};
	            
	    }
	    return $result;
	}	
	
	/**
	 * Generates a HMAC message for payment request form
	 * @param $data The data to include in the hashed message
	 * @return The hashed message
	 */
	public function CMCIC_Hmac($data = '')
	{    
	    $k1 = pack("H*",sha1($this->passPhrase));
	    $l1 = strlen($k1);
	    $k2 = pack("H*",$this->tpe['key']);
	    $l2 = strlen($k2);
	    if ($l1 > $l2):
	        $k2 = str_pad($k2, $l1, chr(0x00));
	    elseif ($l2 > $l1):
	        $k1 = str_pad($k1, $l2, chr(0x00));
	    endif;
	
	    if ($data==""):
	        $d = "CtlHmac".sfPaymentCIC::CMCIC_VERSION.$this->tpe['number'];
	    else:
	        $d = $data;
	    endif;
	    
	    return strtolower(sfPaymentCIC::hmac_sha1($k1 ^ $k2, $d));
	}
	

	/**
	 * RFC 2104 HMAC implementation for PHP 4 >= 4.3.0 - Creates a SHA1 HMAC.
	 * Eliminates the need to install mhash to compute a HMAC
	 * Adjusted from the md5 version by Lance Rushing .
	 * @param $key The key
	 * @param $data Data to encode
	 * @return Returns the SHA1-HMAC computed string
	 */
	private static function hmac_sha1($key, $data)
	{	    
	    $length = 64; // block length for SHA1
	    if (strlen($key) > $length) { $key = pack("H*",sha1($key)); }
	    $key  = str_pad($key, $length, chr(0x00));
	    $ipad = str_pad('', $length, chr(0x36));
	    $opad = str_pad('', $length, chr(0x5c));
	    $k_ipad = $key ^ $ipad ;
	    $k_opad = $key ^ $opad;
	
	    return sha1($k_opad  . pack("H*",sha1($k_ipad . $data)));
	}	
}
