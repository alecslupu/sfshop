<?php

/**
 * Subclass for representing a row from the 'option_product' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionProduct extends BaseOptionProduct
{
    public function getOptionValueJoinOptionType()
    {
        $criteria = new Criteria();
        $criteria->add(OptionValuePeer::ID, $this->getOptionValueId());
        list($optionValue) = OptionValuePeer::doSelectJoinOptionType($criteria);
        return $optionValue;
    }
}
