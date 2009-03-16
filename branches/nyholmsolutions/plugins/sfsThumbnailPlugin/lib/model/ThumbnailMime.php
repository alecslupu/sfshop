<?php

/**
 * Subclass for representing a row from the 'thumbnails_mime' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class ThumbnailMime extends BaseThumbnailMime
{
    public function __toString() {
        return $this->getMime();    
    }
    
}
