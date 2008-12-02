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
    * Gets all languages.
    *
    * @param  object $criteria
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        return self::doSelect($criteria);
    }
}
