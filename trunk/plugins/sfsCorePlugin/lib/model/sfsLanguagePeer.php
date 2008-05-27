<?php

/**
 * Subclass for performing query and update operations on the 'languages' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class sfsLanguagePeer extends BasesfsLanguagePeer
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
    * Gets all active languages.
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, 1);
        return self::doSelectOne($criteria);
    }
}
