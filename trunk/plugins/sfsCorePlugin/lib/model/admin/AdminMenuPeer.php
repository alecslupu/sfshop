<?php

/**
 * Subclass for performing query and update operations on the 'admin_menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.admin
 */ 
class AdminMenuPeer extends BaseAdminMenuPeer
{
    public static function getItem($module, $action)
    {
        $c1 = new Criteria();
        $c1->addAnd(self::ROUTE, $module . '_' . $action, Criteria::EQUAL);
        
        $c2 = new Criteria();
        $c2->addAnd(self::ROUTE, $module . '_%', Criteria::LIKE);
        
        if (self::doCount($c2) > 1) {
            $item = self::doSelectOne($c1);
        } else {
            $item = self::doSelectOne($c2);
        }
        
        return $item;
    }
    
    
    public static function getItems($parentId = null)
    {
        $c = new Criteria();
        $c->addAnd(self::IS_ACTIVE, 1, Criteria::EQUAL);
        if ($parentId === null) {
            $c->addAnd(self::PARENT_ID, null, Criteria::ISNULL);
        } else {
            $c->addAnd(self::PARENT_ID, $parentId, Criteria::EQUAL);
        }
        $c->addAscendingOrderByColumn(self::POS);
        
        return self::doSelect($c);
    }
}
