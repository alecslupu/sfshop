<?php

/**
 * Subclass for performing query and update operations on the 'tax_type' table.
 *
 * 
 *
 * @package plugins.sfsTaxPlugin.lib.model
 */ 
class PluginTaxTypePeer extends BaseTaxTypePeer
{
    static public function getTaxRatesArray()
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(TaxTypePeer::NAME);
        $rateTypes = self::doSelect($c);
        $rate_array = array('0' => 0);
        if($rateTypes) {
            foreach($rateTypes as $rateType) {
                $rate = TaxRatePeer::getRateForTaxGroups($rateType->getId(),sfConfig::get('app_tax_default_tax_groups', 0));
                if($rate)
                    $rate_array[] = $rate;
            }            
        }
        return $rate_array;
    }
    
}
