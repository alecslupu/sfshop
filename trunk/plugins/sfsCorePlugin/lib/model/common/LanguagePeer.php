<?php

/**
 * Subclass for performing query and update operations on the 'languages' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class LanguagePeer extends BaseLanguagePeer
{
   /**
    * Gets default language
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getDefault()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_DEFAULT, 1);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Get language object by culture.
    *
    * @param  string $culture
    * @return mixed if language exist returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByCulture($culture, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::CULTURE, $culture, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
    
}
