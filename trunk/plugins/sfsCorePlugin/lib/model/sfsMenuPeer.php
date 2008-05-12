<?php

/**
 * Subclass for performing query and update operations on the 'menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class sfsMenuPeer extends BasesfsMenuPeer
{
    const TYPE_TOP     = 1;
    const TYPE_BOTTOM  = 2;
    const TYPE_PROFILE = 3;
    const TYPE_MAIN    = 4;
    
    /**
    * Gets menu items by menu type.
    *
    * @param  integer $type
    * @param  string $culture
    * @return object.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getItemsByType($type, $culture = null)
    {
        $criteria = new Criteria();
        $criteria->add(self::TYPE, $type);
        $criteria->addAscendingOrderByColumn(self::POS);
        return self::doSelectWithI18n($criteria, $culture);
    }
}
