<?php 
function paypal_rate($price)
{
    $rate = $price * (sfConfig::get('app_payment_paypal_rate', 1) /100 ) + 0.30;
    return round($rate, 2);
}

function paypal_total_with_rate($price)
{
    $total = $price + paypal_rate($price);
    return round($total, 2);
}

?>