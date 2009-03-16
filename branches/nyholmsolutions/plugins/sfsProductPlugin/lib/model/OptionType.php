<?php

/**
 * Subclass for representing a row from the 'option_type' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionType extends BaseOptionType
{
    public function __toString()
    {
        return $this->getTitle();
    }
}
