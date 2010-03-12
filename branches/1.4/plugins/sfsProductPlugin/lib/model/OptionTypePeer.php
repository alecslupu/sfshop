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
    public static function addPublicCriteria(Criteria $criteria)
    {
    }
    public static function getAll($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        return self::doSelectWithI18n($criteria);
    }


}
