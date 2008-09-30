<?php

/**
 * Subclass for performing query and update operations on the 'option_value' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class OptionValuePeer extends BaseOptionValuePeer
{
    
   /**
    * Get option values by $optionTypeId.
    * 
    * @param  int $optionTypeId
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByTypeId($typeId, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::TYPE_ID, $typeId);
        return self::doSelect($criteria);
    }
}
