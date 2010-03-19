<?php

/**
 * Subclass for representing a row from the 'menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class Menu extends BaseMenu
{
    public function __toString() {
        return $this->getTitle();
    }
    
}