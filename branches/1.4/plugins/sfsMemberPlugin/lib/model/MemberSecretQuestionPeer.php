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
    * Gets all records.
    * 
    * @param  $criteria
    * @return array
    * @author Sebastien HEITZMANN
    * @access public
    */
    public static function getAll($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        if ($withI18n) {
            return self::doSelectWithI18n($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
 
}
