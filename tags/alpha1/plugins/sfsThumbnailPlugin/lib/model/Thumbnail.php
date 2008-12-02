<?php

/**
 * Subclass for representing a row from the 'thumbnails' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class Thumbnail extends BaseThumbnail
{
   /**
    * Gets url to thumbnail.
    * 
    * @param  void
    * @return string
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
            . '.'
            . $this->getMimeExtension()
        ;
    }
    
   /**
    * Gets path on a storage to thumbnail.
    * 
    * @param  string $type
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getStoragePath()
    {
        if ($this->getParentId() == null) {
            $thumbnailDir = sfConfig::get('app_thumbnails_original_dir_name');
        }
        else {
            $thumbnailDir = sfConfig::get('app_thumbnails_converted_dir_name');
        }
        
        return sfConfig::get('sf_web_dir') 
            . DIRECTORY_SEPARATOR 
            . sfConfig::get('app_thumbnails_dir')
            . DIRECTORY_SEPARATOR 
            . $thumbnailDir
            . DIRECTORY_SEPARATOR 
            . $this->getPath() 
            . DIRECTORY_SEPARATOR
            . $this->getUuid()
            . '.'
            . $this->getMimeExtension();
        
    }
}
