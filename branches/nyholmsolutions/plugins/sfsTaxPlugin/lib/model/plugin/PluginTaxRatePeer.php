<?php

/**
 * Subclass for performing query and update operations on the 'tax_rate' table.
 *
 * 
 *
 * @package plugins.sfsTaxPlugin.lib.model
 */ 
class PluginTaxRatePeer extends BaseTaxRatePeer
{
	
   /**
    * Calculate gross price
    * Net price is returned if taxes are globally disabled
    * 
    * @param  decimal $price
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    static public function calculateGrossPrice($price,$taxTypeId)
    {
        if(!$taxTypeId || !sfConfig::get('app_tax_is_enabled', false))
            return $price;
        
        $user = sfContext::getInstance()->getUser();
        if($user->getAttribute('tax_group_id', null, 'order/tax'))
            return $price * TaxRatePeer::getRateForTaxGroups($taxTypeId,$user->getTaxGroup(),true);
        
        return $price * TaxRatePeer::getRateForTaxGroups($taxTypeId,sfConfig::get('app_tax_default_tax_groups', 0),true);
    } 
    	
   /**
    * Gets tax rate from tax group(s) and tax type
    * 
    * @param  int $taxTypeId ,mixed $taxGroupIds, bool $returnDecimal = false
    * @return decimal
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    static public function getRateForTaxGroups($taxTypeId, $taxGroupIds, $returnDecimal = false)
    {
        if(!is_array($taxGroupIds))
            $taxGroupIds = array($taxGroupIds);
            
        if(!$taxTypeId || !$taxGroupIds[0]) {
            if($returnDecimal)
                return 1;   // return decimal value 1 = 1.00 (no added tax) 
            else
                return 0;   // return in percent. 0 = 0 percent tax.
        } 
        
        $criteria = new Criteria();
        $criteria->add(TaxRatePeer::TAX_GROUP_ID, $taxGroupIds, Criteria::IN);
        $criteria->add(TaxRatePeer::TAX_TYPE_ID, $taxTypeId);
        $criteria->clearSelectColumns();
        $criteria->addSelectColumn('SUM(' . TaxRatePeer::RATE . ')');
        $criteria->addGroupByColumn(TaxRatePeer::PRIORITY);
        $stmt = TaxRatePeer::doSelectStmt($criteria);
        $decimalTax = 1.0;
        while($res = $stmt->fetchColumn(0)) {
           $decimalTax = $decimalTax * 1.0 + ($res/100);  
        }
        if($returnDecimal)
            return $decimalTax; 
        else
            return ($decimalTax - 1) * 100;   // return in percent
    }
    
}
