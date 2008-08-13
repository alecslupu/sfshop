<?php

/**
 * Subclass for performing query and update operations on the 'option_type' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionTypePeer extends BaseOptionTypePeer
{
   /**
    * Gets all option types.
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
}
