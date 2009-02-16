<?php 
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function get_brands_for_select()
{
    $arBrands = array();
    $arBrands[''] = '';
    
    $criteria = new Criteria();
    $brands = BrandPeer::getAll($criteria);
    
    foreach ($brands as $brand) {
        $arBrands[$brand->getId()] = $brand->getTitle();
    }
    
    return $arBrands;
}


?>