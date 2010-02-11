<?php

/**
 * Subclass for performing query and update operations on the 'asset_type' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class AssetTypePeer extends BaseAssetTypePeer
{
   /**
    * Get asset type by model.
    * 
    * @param  string $model
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByModel($model)
    {
        $criteria = new Criteria();
        $criteria->add(self::MODEL, $model);
        return self::doSelectOne($criteria);
    }
}
