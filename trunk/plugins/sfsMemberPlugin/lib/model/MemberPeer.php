<?php

/**
 * Subclass for performing query and update operations on the 'members' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class MemberPeer extends BaseMemberPeer
{
    const CONFIRMED = 1;
    const RECONFIRM = 2;
    
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
        $criteria->add(self::EMAIL, $email, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Get member object by confirm code.
    *
    * @param  string $email
    * @return mixed if member exist returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByConfirmCode($confirmCode)
    {
        if (self::$member == null) {
            $criteria = new Criteria();
            $criteria->add(self::CONFIRM_CODE, $confirmCode, Criteria::EQUAL);
            return self::doSelectOne($criteria);
        } else {
            return self::$member;
        }
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
    
   /**
    * Generates password.
    *
    * @return string with password.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function generatePassword()
    {
        return substr(md5(time() . uniqid()), 0, 8);
    }
}
