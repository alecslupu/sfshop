<?php

/**
 * Subclass for performing query and update operations on the 'admin' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.admin
 */ 
class AdminPeer extends BaseAdminPeer
{
    
    
   /**
    * Get admin object by id
    *
    * @param  int $id
    * @return mixed if admin exist returns object, otherwise null
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public static function retrieveById($id)
    {
        $criteria = new Criteria();
        $criteria->add(self::ID, $id, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
    
    
    
   /**
    * Get admin object by id
    *
    * @param  string $username
    * @return mixed if admin exist returns object, otherwise null
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public static function retrieveByUsername($username)
    {
        $criteria = new Criteria();
        $criteria->add(self::USERNAME, $username, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
}
