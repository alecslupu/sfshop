<?php

/**
 * Subclass for performing query and update operations on the 'products' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class sfsProductPeer extends BasesfsProductPeer
{
    /**
    * Gets criteria for get all avaliable products.
    * 
    * @param  $criteria
    * @return $criteria
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getPublicCriteria($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        else {
            $criteria->add(self::IS_ACTIVE, 1);
        }
        
        return $criteria;
    }
}
