<?php

/**
 * Subclass for performing query and update operations on the 'categories' table.
 *
 * 
 *
 * @package plugins.sfsCategoryPlugin.lib.model
 */ 
class sfsCategoryPeer extends BasesfsCategoryPeer
{
    /**
    * Gets all avaliable categories with parent_id 0.
    *
    * @param  void
    * @return array with objects, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getFirstLevel()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, 1);
        $criteria->add(self::PARENT_ID, 0);
        $criteria->addAscendingOrderByColumn(sfsCategoryI18nPeer::TITLE);
        return self::doSelectWithI18n($criteria);
    }
}
