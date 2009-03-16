<?php

/**
 * Subclass for representing a row from the 'thumbnail_type_asset_type' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class ThumbnailTypeAssetType extends BaseThumbnailTypeAssetType
{
    public function __toString() {
        return $this->getThumbnailTypeName();    
    }
}
