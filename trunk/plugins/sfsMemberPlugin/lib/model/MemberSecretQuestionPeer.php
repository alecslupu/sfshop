<?php

/**
 * Subclass for performing query and update operations on the 'member_secret_question' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class MemberSecretQuestionPeer extends BaseMemberSecretQuestionPeer
{
    /**
    * Gets all records from secret questions table.
    * 
    * @return array with objects
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAllAvaliable()
    {
        return self::doSelectWithTranslation(new Criteria());
    }
}
