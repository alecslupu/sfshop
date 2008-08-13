<?php 

function get_brands_for_select()
{
    $arBrands = array();
    $arBrands[''] = '[no brand]';
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(BrandI18nPeer::TITLE);
    $brands = BrandPeer::doSelectWithI18n($c);
    
    foreach ($brands as $brand) {
        $arBrands[$brand->getId()] = $brand->getTitle();
    }
    
    return $arBrands;
}


?>