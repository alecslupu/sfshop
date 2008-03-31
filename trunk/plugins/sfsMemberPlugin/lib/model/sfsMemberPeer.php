<?php

/**
 * Subclass for performing query and update operations on the 'members' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class sfsMemberPeer extends BasesfsMemberPeer
{
    const CONFIRMED = 1;
    
    protected static $member = null;
    
    /**
    * Get member object by email.
    *
    * @param  string $email
    * @return mixed if member exist returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByEmail($email)
    {
        $criteria = new Criteria();
        $criteria->add(sfsMemberPeer::EMAIL, $email);
        return sfsMemberPeer::doSelectOne($criteria);
    }
    
    /**
    * Generates confirm code
    *
    * @return string with confirm code.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function generateConfirmCode()
    {
        return md5(time() . uniqid());
    }
}
