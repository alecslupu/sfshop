<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Subclass for performing query and update operations on the 'basket_product' table.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nest@dev-zp.com>, Andrey Kotlyarov
 * @version    SVN: $Id: BasketProduct.php 6174 2007-11-27 06:22:40Z fabien $
 */
class BasketProductPeer extends BaseBasketProductPeer
{
   /**
    * Gets product added to basket by basket id, product id and options list.
    *
    * @param  int $basketId
    * @param  int $productId
    * @return object
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function retrieveByBasketIdAndProductId($basketId, $productId, $optionsList = null)
    {
        $criteria = new Criteria();
        $criteria->add(self::BASKET_ID, $basketId);
        $criteria->add(self::PRODUCT_ID, $productId);
        
        if ($optionsList !== null) {
            $criteria->add(self::OPTIONS_LIST, $optionsList);
        }
        
        return self::doSelectOne($criteria);
    }
    
   /**
    * Gets quantity sum of product.
    *
    * @param  int $productId
    * @return int
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function retrieveQuantityByProductId($productId)
    {
        $criteria =new Criteria();
        $criteria->addSelectColumn('SUM(' . self::QUANTITY . ') as sum');
        $criteria->addSelectColumn(self::QUANTITY);
        
        $criteria->addGroupByColumn(self::PRODUCT_ID);
        $criteria2 = $criteria->getNewCriterion(self::PRODUCT_ID, $productId);
        $criteria->addHaving($criteria2);
        $rs = self::doSelectRS($criteria);
        
        $sum = 0;
        
        while ($rs->next()) {
            $sum = $rs->getString(1);
        }
        
        return $sum;
    }
    
   /**
    * Delete all products from current basket.
    *
    * @param  int $basketId
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public static function deleteAllProductsByBasketId($basketId)
    {
        $criteria = new Criteria();
        $criteria->add(self::BASKET_ID, $basketId);
        
        $con = Propel::getConnection(self::DATABASE_NAME);
        BasePeer::doDelete($criteria, $con);
    }
}
