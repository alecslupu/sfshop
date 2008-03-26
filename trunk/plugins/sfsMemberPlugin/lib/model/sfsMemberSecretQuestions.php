<?php

/**
 * Subclass for representing a row from the 'members_secret_questions' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class sfsMemberSecretQuestions extends BasesfsMemberSecretQuestions
{
    public function __toString()
    {
        return $this->getQuestion();
    }
}
