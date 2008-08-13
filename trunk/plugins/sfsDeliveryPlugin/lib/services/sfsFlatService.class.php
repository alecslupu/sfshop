<?php

class sfsFlatService extends sfsBaseService {
    
    protected $params = array();
    
    public function getQuote($deliveryAddress, $weight, $cube, $numBoxes, $totalPrice, $params = array(), $method = '')
    {
        $this->quotes = array(array(
            'id'    => 1,
            'title' => $this->params['title'],
            'price' => $this->params['price']
        ));
        return $this->quotes;
    }
}
