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
   /**
    * Gets all countries.
    *
    * @param  object $criteria
    * @return array with objcts.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        return self::doSelectWithTranslation($criteria);
    }
    
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
