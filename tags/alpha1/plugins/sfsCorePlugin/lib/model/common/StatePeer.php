<?php

/**
 * Subclass for performing query and update operations on the 'state' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.common
 */ 
class StatePeer extends BaseStatePeer
{
    public static function getByCountryId($countryId = null, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->addAnd(self::COUNTRY_ID, $countryId, Criteria::EQUAL);
        
        if ($withI18n) {
            return self::doSelectWithI18n($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
    
    public static function getHashByCountryId($countryId = null, $criteria = null)
    {
        $states = self::getByCountryId($countryId, $criteria, true);
        $hash = array();
        
        if (count($states) > 0) {
            
            foreach ($states as $state) {
                $hash[$state->getId()] = $state->getTitle();
            }
        }
        
        return $hash;
    }
    
    public static function getHash($criteria = null)
    {
        $states = self::doSelectWithI18n($criteria);
        $hash = array();
        
        if (count($states) > 0) {
            
            foreach ($states as $state) {
                $hash[$state->getId()] = $state->getTitle();
            }
        }
        
        return $hash;
    }
}
