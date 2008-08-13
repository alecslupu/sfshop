<?php

/**
 * Subclass for performing query and update operations on the 'basket' table.
 *
 * 
 * @author  Andrey Kotlyarov
 * @package plugins.sfsBasketPlugin.lib.model
 */ 
class BasketPeer extends BaseBasketPeer
{
    public static function generate($memberId = null, $basketId = null)
    {
        $basket = null;
        $basketById = self::retrieveByPK($basketId);
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
            } else {
                if ($basketById->hasProducts()) {
                    $basket = $basketById;
                    $basketByMemberId->delete();
                } else {
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
}
