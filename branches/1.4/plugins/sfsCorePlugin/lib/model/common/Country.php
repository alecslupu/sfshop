<?php

/**
 * Subclass for representing a row from the 'countries' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class Country extends BaseCountry
{
    public function __toString()
    {
        if($this->getTitle())
            return $this->getTitle();
        return $this->getTitleEnglish();
    }
    
}
