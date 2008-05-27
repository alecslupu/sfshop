<?php

/**
 * Subclass for performing query and update operations on the 'countries' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class sfsCountryPeer extends BasesfsCountryPeer
{
    
    /**
    * Gets all countries by culture.
    * 
    * If countries does not exist for this culture returns countries for default culture (en).
    *
    * @param  string $culture
    * @return array with objcts.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByCulture($culture)
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, 1);
        $countries = self::doSelectWithI18n($criteria, $culture);
        
        if ($countries) {
            return $countries;
        }
        else {
            return self::getDefaults();
        }
    }
    
    public static function getDefaults()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, 1);
        return self::doSelect($criteria);
    }
}
