<?php

/**
 * Subclass for representing a row from the 'option_value' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionValue extends BaseOptionValue
{
    public function __toString()
    {
        return $this->getTitle();
    }    
}
