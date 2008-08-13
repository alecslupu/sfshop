<?php

/**
 * Subclass for performing query and update operations on the 'brand' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class BrandPeer extends BaseBrandPeer
{
   /**
    * Gets all brands.
    * 
    * @param  void
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll()
    {
        return self::doSelectWithTranslation(new Criteria());
    }
}
