<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

abstract class sfsBasePaymentService {
    
    protected $params = array();
    protected $errors = array();
    
    public function __construct($params)
    {
        $this->params = $params;
    }
    
    public abstract function getRate($totalPrice, $params = array());
    
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
}