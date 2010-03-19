<?php

/**
 * Subclass for representing a row from the 'admin_menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.admin
 */ 
class AdminMenu extends BaseAdminMenu
{
    public function __toString() {
        return $this->getTitle();
    }
}
