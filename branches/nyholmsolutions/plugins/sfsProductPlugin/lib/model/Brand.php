<?php

/**
 * Subclass for representing a row from the 'brand' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */
class Brand extends BaseBrand
{
    public function __toString()
    {
        return $this->getTitle();
    }
}
