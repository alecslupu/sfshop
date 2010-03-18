<?php

/**
 * Subclass for performing query and update operations on the 'countries' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class CountryPeer extends BaseCountryPeer
{
    public static function retrieveByIsoA3($isoA3)
    {
        $criteria = new Criteria();
        $criteria->addAnd(self::ISO_A3, $isoA3);
        self::addPubliCriteria($criteria);
        return self::doSelectOne($criteria);
    }
    
    public static function getHash($criteria = null)
    {
        $countries = self::getAll($criteria);
        $hash = array();
        
        foreach ($countries as $country) {
            $hash[$country->getId()] = $country->getTitle();
        }
        
        return $hash;
    }
}
