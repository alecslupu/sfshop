<?php

abstract class sfsBaseService {
    
    protected $params = array();
    protected $errors = array();
    
    public function __construct($params) { 
        $this->params = $params;
    }
    
    public abstract function getQuote($deliveryAddress, $weight, $cube, $numBoxes, $totalPrice, $params = array());
    
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