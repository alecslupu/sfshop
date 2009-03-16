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
 * Subclass for performing query and update operations on the 'basket_product2option_product' table.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>, Andrey Kotlyarov
 * @version    SVN: $Id: BasketProduct.php 6174 2007-11-27 06:22:40Z fabien $
 */
class BasketProduct2OptionProductPeer extends BaseBasketProduct2OptionProductPeer
{
   /**
    * Checks, is has added product to basket selected option in the basket.
    *
    * @param  int $basketProductId
    * @param  int $optionProductId
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function hasOption($basketProductId, $optionProductId)
    {
        $criteria = new Criteria();
        $criteria->add(self::BASKET_PRODUCT_ID, $basketProductId);
        $criteria->add(self::OPTION_PRODUCT_ID, $optionProductId);
        return (self::doCount($criteria) > 0);
    }
}
