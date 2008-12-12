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
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseBrandComponents extends sfComponents
{
    public function executeFilterList()
    {
        $this->brands = BrandPeer::getAll(new Criteria(), true);
    }
}
