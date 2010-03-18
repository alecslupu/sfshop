<?php

/**
 * Subclass for representing a row from the 'information' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.common
 */ 
class Information extends BaseInformation
{
    public function __toString()
    {
        return $this->getTitle();
    }
    
}
