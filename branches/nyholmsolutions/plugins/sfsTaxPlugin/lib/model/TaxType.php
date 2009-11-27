<?php

/**
 * Subclass for representing a row from the 'tax_type' table.
 *
 * 
 *
 * @package plugins.sfsTaxPlugin.lib.model
 */ 
class TaxType extends PluginTaxType
{
    public function __toString()
    {
        return $this->getTitle();
    }
}
