<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

abstract class sfsBaseDeliveryService {
    
    protected $params          = array();
    protected $errors          = array();
    
    protected $storeAddress    = array();
    protected $deliveryAddress = array();
    protected $totalWeight          = 0;
    protected $totalPrice      = 0;
    protected $cube            = 0;
    protected $numBoxes        = 1;
    protected $products        = array();
    
    public function __construct($params)
    {
        $this->params = $params;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function setTotalPrice($value)
    {
        $this->totalPrice = $value;
    }
    
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    
    public function setStoreAddress($value)
    {
        $this->storeAddress = $value;
    }
    
    public function getStoreAddress()
    {
        return $this->storeAddress;
    }
    
    public function setDeliveryAddress($value)
    {
        $this->deliveryAddress = $value;
    }
    
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }
    
    public function setTotalWeight($value)
    {
        $this->weight = $value;
    }
    
    public function getTotalWeight()
    {
        return $this->weight;
    }
    
    public function setCube($value)
    {
        $this->cube = $value;
    }
    
    public function getCube()
    {
        return $this->cube;
    }
    
    public function setNumBoxes($value)
    {
        $this->numBoxes = $value;
    }
    
    public function getNumBoxes()
    {
        return $this->numBoxes;
    }
    
    public function setItemProducts($value)
    {
        $this->products = $value;
    }
    
    public function getItemProducts()
    {
        return $this->products;
    }
    
    public abstract function getQuote();
    
    public function setError($error)
    {
        $this->errors[] = $error;
    }
    
    public function isErrorSet()
    {
        if (count($this->errors) > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    
   /**
    * Writes message to log file.
    *
    * @param  string $message
    * @param  int $logLevel
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    protected function logMessage($message, $logLevel = sfLogger::ERR)
    {
        if (sfConfig::get('sf_logging_enabled')) {
            $logger = sfContext::getInstance()->getLogger();
            $logger->log($message, $logLevel);
        }
    }
}