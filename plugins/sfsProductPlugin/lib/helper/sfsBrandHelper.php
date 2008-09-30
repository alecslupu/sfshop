<?php 

function get_brands_for_select()
{
    $arBrands = array();
    $arBrands[''] = __('[no brand]');
    
    $criteria = new Criteria();
    $brands = BrandPeer::getAll($criteria);
    
    foreach ($brands as $brand) {
        $arBrands[$brand->getId()] = $brand->getTitle();
    }
    
    return $arBrands;
}


?>