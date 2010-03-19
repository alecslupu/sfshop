<?php

/**
 * Subclass for performing query and update operations on the 'menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class MenuPeer extends BaseMenuPeer
{
    const TYPE_TOP     = 1;
    const TYPE_BOTTOM  = 2;
    const TYPE_PROFILE = 3;
    const TYPE_MAIN    = 4;
        public static function doSelectWithTranslation(Criteria $c, $culture = null, $con = null)
    {
        $results = self::doSelectWithI18n($c, $culture, $con);
        
        if ($results == null) {
            $defaultCulture = LanguagePeer::getDefault();
            $results = self::doSelectWithI18n($c, $defaultCulture->getCulture());
        }
        
        return $results;
    }
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
        return self::doSelectWithTranslation($criteria, $culture);
    }
}
