<?php

/**
 * Subclass for representing a row from the 'thumbnails' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class sfsThumbnail extends BasesfsThumbnail
{
    /**
    * Gets thumbnail object for current product.
    * 
    * @param  string $type
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getUrl()
    {
        return sfConfig::get('app_thumbnails_web_dir')
            . '/' 
            . sfConfig::get('app_thumbnails_converted_dir_name') 
            . '/' 
            . $this->getPath() 
            . '/'
            . $this->getUuid()
            . '.jpg';
    }
}
