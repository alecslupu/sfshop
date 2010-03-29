<?php

/**
 * Subclass for representing a row from the 'brand' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */
class Brand extends BaseBrand
{
    public function __toString()
    {
        return $this->getTitle();
    }
    
   /**
    * Gets thumbnail object for current brand.
    *
    * @param  string $type
    * @return object
    * @author Florian Klein <florian@2le.net>
    * @access public
    */
    public function getThumbnails($thumbnailType)
    {
        return ThumbnailPeer::doSelectByTypeAndAssetId($thumbnailType, $this->getId(), get_class($this));
    }
}
