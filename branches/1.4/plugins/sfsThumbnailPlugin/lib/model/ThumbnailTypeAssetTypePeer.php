<?php

/**
 * Subclass for performing query and update operations on the 'thumbnail_type_asset_type' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class ThumbnailTypeAssetTypePeer extends BaseThumbnailTypeAssetTypePeer
{
   /**
    * Gets thumbnail type asset type object by $assetTypeId.
    * 
    * @param  int $assetTypeId
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByAssetTypeId($assetTypeId)
    {
        $criteria = new Criteria();
        $criteria->add(self::ASSET_TYPE_ID, $assetTypeId);
        return self::doSelect($criteria);
    }
    
   /**
    * Gets thumbnail type asset type object by $thumbnailTypeName.
    * 
    * @param  string $thumbnailTypeName
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByThumbnailTypeName($thumbnailTypeName)
    {
        $criteria = new Criteria();
        $criteria->add(self::THUMBNAIL_TYPE_NAME, $thumbnailTypeName);
        return self::doSelectOne($criteria);
    }
}
