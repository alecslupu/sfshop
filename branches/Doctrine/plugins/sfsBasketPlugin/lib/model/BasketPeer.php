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
 * Subclass for performing query and update operations on the 'basket' table.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.model
 * @author     Andrey Kotlyarov
 * @version    SVN: $Id: BasketPeer.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class BasketPeer extends BaseBasketPeer
{
   /**
    * If basket does not exists for some member, will generate new, otherwise returns object of basket which already exists.
    *
    * @param  void
    * @return object
    * @author Andrey Kotlyarov
    * @access public
    */
    public static function generate($memberId = null, $basketId = null)
    {
        $basket = null;
        $basketById = self::retrieveById($basketId);
        $basketByMemberId = null;
        
        if ($memberId !== null) {
            $c = new Criteria();
            $c->addAnd(self::MEMBER_ID, $memberId, Criteria::EQUAL);
            $basketByMemberId = self::doSelectOne($c);
        }
        
        if ($basketById === null && $basketByMemberId === null) {
            $basket = new Basket();
            $currency = CurrencyPeer::retrieveDefault();
            $basket->setCurrencyId($currency->getId());
        }
        
        if ($basketById === null && $basketByMemberId !== null) {
            $basket = $basketByMemberId;
        }
        
        if ($basketById !== null && $basketByMemberId === null) {
            $basket = $basketById;
        }
        
        if ($basketById !== null && $basketByMemberId !== null) {
            if ($basketById->getId() == $basketByMemberId->getId()) {
                $basket = $basketById;
            }
            else {
                if ($basketById->hasProducts()) {
                    $basket = $basketById;
                    $basketByMemberId->delete();
                }
                else {
                    $basket = $basketByMemberId;
                    $basketById->delete();
                }
            }
        }
        
        $basket->setMemberId($memberId);
        $basket->setAccessNum($basket->getAccessNum() + 1);
        $basket->save();
        
        return $basket;
    }
   /**
    * Get member object by id.
    *
    * @param  string $id
    * @return mixed if member exist returns object, otherwise null.
    * @author Sébastien HEITZMANN
    * @access public
    */

   public static function retrieveById($id, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID,(int) $id);
        
        if ($withI18n) {
            $criteria->setLimit(1);
            list($object) = self::doSelectWithI18n($criteria);
            return $object;
        }
        else {
            return self::doSelectOne($criteria);
        }
    }
 
}
