<?php 
function format_currency($price = 0)
{
    if (method_exists(sfContext::getInstance()->getUser(), 'getBasket')) {
        $basket = sfContext::getInstance()->getUser()->getBasket();
        $currency = $basket->getCurrency();
    }
    else {
        $currency = CurrencyPeer::retrieveDefault();
    }
    
    $symbol = '';
    
    if ($price < 0) {
        $price = $price * (-1);
        $symbol = '-';
    }
    
    return $symbol
        . $currency->getSymbolLeft() 
        . number_format(
            round($price * $currency->getValue(), 
                $currency->getDecimalPlaces()
            ),
            $currency->getDecimalPlaces(),
            $currency->getDecimalPoint(),
            $currency->getThousandsPoint()
        )
        . $currency->getSymbolRight();
}

?>