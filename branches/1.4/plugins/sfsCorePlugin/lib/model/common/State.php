<?php

/**
 * Subclass for representing a row from the 'state' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.common
 */ 
class State extends BaseState
{
    public function __toString()
    {
        if($this->getTitle())
            return $this->getTitle();
        return $this->getTitleEnglish();
    }
    
}
