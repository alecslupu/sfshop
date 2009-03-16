<?php

/**
 * Subclass for representing a row from the 'email_template' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class EmailTemplate extends BaseEmailTemplate
{
    public function __toString()
    {
        return $this->getTitle();
    }
        
}
