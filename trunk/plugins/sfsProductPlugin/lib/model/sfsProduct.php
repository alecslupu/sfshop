<?php

/**
 * Subclass for representing a row from the 'products' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class sfsProduct extends BasesfsProduct
{
    /**
    * Gets thumbnail object for current product.
    * 
    * @param  string $type
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getThumbnail($thumbnailType)
    {
        return sfsThumbnailPeer::retrieveByTypeAndAssetId($thumbnailType, $this->getId(), get_class($this));
    }
}
