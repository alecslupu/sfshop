<?php

/**
 * Subclass for performing query and update operations on the 'thumbnails' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class sfsThumbnailPeer extends BasesfsThumbnailPeer
{
    const SMALL  = 'small';
    const MEDIUM = 'medium';
    const LARGE  = 'large';
    
    /**
    * Gets all unconverted thumbnails.
    * 
    * @param  int $categoryId
    * @return array with ids
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getUnconverted()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_CONVERTED, 0);
        $criteria->add(self::IS_ORIGINAL, 0);
        return self::doSelect($criteria);
    }
    
    /**
    * Gets thumbnail object for some asset.
    * 
    * @param  string $thumbnailType
    * @param  int $assetId
    * @param  string $assetModel
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByTypeAndAssetId($thumbnailType, $assetId, $assetModel)
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_CONVERTED, 1);
        $criteria->add(self::IS_ORIGINAL, 0);
        $criteria->add(self::IS_BLANK, 0);
        $criteria->add(self::ASSET_ID, $assetId);
        $criteria->add(self::THUMBNAIL_TYPE, $thumbnailType);
        $criteria->add(self::ASSET_MODEL, $assetModel);
        $thumbnail = self::doSelectOne($criteria);
        
        if ($thumbnail == null) {
            $criteria = new Criteria();
            $criteria->add(self::IS_CONVERTED, 1);
            $criteria->add(self::IS_ORIGINAL, 0);
            $criteria->add(self::IS_BLANK, 1);
            $criteria->add(self::THUMBNAIL_TYPE, $thumbnailType);
            $criteria->add(self::ASSET_MODEL, $assetModel);
            $thumbnail = self::doSelectOne($criteria);
        }
        
        return $thumbnail;
    }
}
