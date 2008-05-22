<?php

/**
 * Subclass for performing query and update operations on the 'members_secret_questions' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class sfsMemberSecretQuestionsPeer extends BasesfsMemberSecretQuestionsPeer
{
    /**
    * Gets all records from secret questions table.
    * 
    * @return array with objects
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getQuestionsWithI18n()
    {
        return self::doSelectWithI18n(new Criteria());
    }
}
