<?php

/**
 * Subclass for representing a row from the 'member_secret_question' table.
 *
 * 
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class MemberSecretQuestion extends BaseMemberSecretQuestion
{
    public function __toString()
    {
        return $this->getQuestion();
    }
}
