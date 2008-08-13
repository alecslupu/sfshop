<?php

/**
 * Subclass for performing query and update operations on the 'information' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.common
 */ 
class InformationPeer extends BaseInformationPeer
{
    
   /**
    * Get information object by id.
    *
    * @param  int $id
    * @param  object $criteria
    * @return mixed if information exist returns object, otherwise null
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById($id, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        $criteria->add(self::ID, $id, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
}
