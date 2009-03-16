<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Brand components.
 *
 * @package    plugins.sfsProductsPlugin
 * @subpackage modules.brand
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseBrandComponents extends sfComponents
{
    public function executeFilterList()
    {
        $this->brands = BrandPeer::getAll(new Criteria(), true);
        //$this->brands = BrandPeer::getBrandsFromCurrentCategory();
    }
}
