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
    public static function getByCountryIdWithI18n($countryId = null, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->addAnd(self::COUNTRY_ID, $countryId, Criteria::EQUAL);
        
        return self::doSelectWithI18n($criteria);
    }
    
    public static function getHashByCountryId($countryId = null, $criteria = null)
    {
        $states = self::getByCountryIdWithI18n($countryId, $criteria);
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
