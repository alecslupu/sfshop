<?php

/**
 * Subclass for performing query and update operations on the 'thumbnails' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class ThumbnailPeer extends BaseThumbnailPeer
{
    const MINI     = 'mini';
    const SMALL    = 'small';
    const MEDIUM   = 'medium';
    const LARGE    = 'large';
    const ORIGINAL = 'original';
    
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
        $criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, self::ORIGINAL, Criteria::NOT_EQUAL);
        return self::doSelectJoinThumbnailTypeAssetType($criteria);
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
    public static function retrieveByTypeAndAssetId($thumbnailTypeName, $assetId, $assetTypeModel)
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_CONVERTED, 1);
        $criteria->add(self::IS_BLANK, 0);
        $criteria->add(self::ASSET_ID, $assetId);
        $criteria->add(self::ASSET_TYPE_MODEL, $assetTypeModel);
        $criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, $thumbnailTypeName);
        $criteria->setLimit(1);
        $thumbnail = self::doSelectJoinThumbnailTypeAssetType($criteria);
        
        if (count($thumbnail) > 0) {
            list($thumbnail) = $thumbnail;
        }
        else {
            $criteria = new Criteria();
            $criteria->add(self::IS_CONVERTED, 1);
            $criteria->add(self::IS_BLANK, 1);
            $criteria->add(self::ASSET_TYPE_MODEL, $assetTypeModel);
            $criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, $thumbnailTypeName);
            $criteria->setLimit(1);
            $thumbnail = self::doSelectJoinThumbnailTypeAssetType($criteria);
            
            if (count($thumbnail) > 0) {
                list($thumbnail) = $thumbnail;
            }
            else {
                $thumbnail = null;
            }
        }
        
        return $thumbnail;
    }
    
   /**
    * Deletes all thumbnails for some asset. Also deletes thumbnail files from storage.
    * 
    * @param  int $assetId
    * @param  string $assetTypeModel
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function deleteByAssetIdAndAssetTypeModel($assetId, $assetTypeModel)
    {
        $criteria = new Criteria();
        $criteria->add(self::ASSET_ID, $assetId);
        $criteria->add(self::ASSET_TYPE_MODEL, $assetTypeModel);
        $criteria->add(self::PARENT_ID, null, Criteria::ISNULL);
        $parentThumbnail = self::doSelectOne($criteria);
        
        if ($parentThumbnail !== null) {
            $criteria->add(self::PARENT_ID, $parentThumbnail->getId());
            $thumbnails = self::doSelect($criteria);
            
            if (count($thumbnails) > 0) {
                foreach ($thumbnails as $thumbnail) {
                    sfsThumbnailUtil::unlink($thumbnail->getStoragePath());
                    $thumbnail->delete();
                }
            }
            
            $parentThumbnail->delete();
        }
    }
    
   /**
    * Generate and convert thumbnails for some asset.
    * TODO: This only work for onw image/asset. 
    * This should be improved to check and possible update all thumbs for asset
    * This also help if new ttat:s have been added
    * 
    * @param  string $asset Object
    * @return void
    * @author Andreas Nyholm
    * @access public
    */
    public static function updateThumbnails($asset_object)
    { 
            
        if(!$thumbnailOrig = self::retrieveByTypeAndAssetId(ThumbnailPeer::ORIGINAL, $asset_object->getId(), get_class($asset_object)))
            return;
        $c = new Criteria();
        $c->add(self::PARENT_ID, $thumbnailOrig->getId());
        $thumbnails = self::doSelect($c);
        if($thumbnails) {
            foreach($thumbnails as $thumbnail) {
                $thumbnail->setIsConverted(false);
                $thumbnail->setMimeId($thumbnailOrig->getMimeId());
                $thumbnail->setMimeExtension($thumbnailOrig->getMimeExtension());
                $thumbnail->save();
            }
        } 
        else {
            $assetType = AssetTypePeer::retrieveByModel($thumbnailOrig->getAssetTypeModel());
            if($assetType)
                $thumbnailTypesAssetTypes = ThumbnailTypeAssetTypePeer::getByAssetTypeId($assetType->getId());
            
            if (count($thumbnailTypesAssetTypes) > 0) {
                foreach ($thumbnailTypesAssetTypes as $thumbnailTypeAssetType) {
                    if($thumbnailTypeAssetType->getId() != $thumbnailOrig->getTtatId()) {
                        $thumbnail = new Thumbnail();
                        $thumbnail->setParentId($thumbnailOrig->getId());
                        $thumbnail->setAssetId($thumbnailOrig->getAssetId());
                        $thumbnail->setTtatId($thumbnailTypeAssetType->getId());
                        $thumbnail->setPath($thumbnailOrig->getPath());
                        $thumbnail->setMimeId($thumbnailOrig->getMimeId());
                        $thumbnail->setMimeExtension($thumbnailOrig->getMimeExtension());
                        $thumbnail->setUuid(md5(time() + rand()).'.'.$thumbnailOrig->getMimeExtension());
                        $thumbnail->setAssetTypeModel($assetType->getModel());
                        $thumbnail->save();
                    }
                }
            }
        }       
        sfsThumbnailUtil::convert();
    }
    
    
   /**
    * Generate thumbnail queue for some asset. Returns object of original thumbnail.
    * 
    * @param  int $assetId
    * @param  string $assetTypeModel
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function generate($assetId, $assetDirName, $assetTypeModel)
    {
        $assetType = AssetTypePeer::retrieveByModel($assetTypeModel);
        $thumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByThumbnailTypeName(self::ORIGINAL);
        
        $path = date('Y/m/d');
        $originalThumbnail = new Thumbnail();
        $originalThumbnail->setTtatId($thumbnailTypeAssetType->getId());
        $originalThumbnail->setAssetId($assetId);
        $originalThumbnail->setAssetTypeModel($assetType->getModel());
        $originalThumbnail->setUuid(md5(time() + rand()));
        $originalThumbnail->setTtatId($thumbnailTypeAssetType->getId());
        $originalThumbnail->setPath($assetDirName . '/' . $path);
        $originalThumbnail->setIsConverted(1);
        $originalThumbnail->save();
        
        $thumbnailTypesAssetTypes = ThumbnailTypeAssetTypePeer::getByAssetTypeId($assetType->getId());
        
        if (count($thumbnailTypesAssetTypes) > 0) {
            foreach ($thumbnailTypesAssetTypes as $thumbnailTypeAssetType) {
                $thumbnail = new Thumbnail();
                $thumbnail->setParentId($originalThumbnail->getId());
                $thumbnail->setAssetId($assetId);
                $thumbnail->setTtatId($thumbnailTypeAssetType->getId());
                $thumbnail->setPath($assetDirName . '/' . $path);
                $thumbnail->setUuid(md5(time() + rand()));
                $thumbnail->setAssetTypeModel($assetType->getModel());
                $thumbnail->save();
            }
        }
        
        return $originalThumbnail;
    }
}
