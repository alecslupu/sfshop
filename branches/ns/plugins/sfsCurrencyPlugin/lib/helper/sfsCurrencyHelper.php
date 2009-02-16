<?php 

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function format_currency($price = 0, $currency = null, $clearValue = false, $noConversion = false)
{
    if ($currency != null) {
        if(is_int($currency))
            $currency = CurrencyPeer::retrieveByPk($currency);
        else
            $currency = CurrencyPeer::retrieveByCode($currency);
    }
    else if (method_exists(sfContext::getInstance()->getUser(), 'getBasket')) {
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
    
    $symbolLeft = '';
    $symbolRight = '';
    $thousandsPoint = '';
    
    if (!$clearValue) {
        $symbolLeft = $currency->getSymbolLeft();
        $symbolRight = $currency->getSymbolRight();
        $thousandsPoint = $currency->getThousandsPoint();
    }
    
    if(!$noConversion)
        $price = $price * $currency->getValue();
    
    return $symbol
        . $symbolLeft
        . number_format(
            round($price, 
                $currency->getDecimalPlaces()
            ),
            $currency->getDecimalPlaces(),
            $currency->getDecimalPoint(),
            $thousandsPoint
        )
        . $symbolRight;
}

function exchange_to_default_currency($price, $fromCurrencyCode)
{
    $currencyFrom = CurrencyPeer::retrieveByCode($fromCurrencyCode);
    return $price / $currencyFrom->getValue();
}

?>