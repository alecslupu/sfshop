<?php

/**
 * Subclass for representing a row from the 'tax_group' table.
 *
 * 
 *
 * @package plugins.sfsTaxPlugin.lib.model
 */ 
class PluginTaxGroup extends BaseTaxGroup
{
    function __toString() {
        return $this->getTitle();
    }
    
}
