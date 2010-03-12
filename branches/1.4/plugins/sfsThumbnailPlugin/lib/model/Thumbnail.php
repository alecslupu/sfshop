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
    public function __toString() {
        return $this->getUuid();    
    }
    
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
    
    public function getUploadUrl()
    {
        $c = new Criteria();
        $c->addJoin(ThumbnailTypeAssetTypePeer::ID,ThumbnailPeer::TTAT_ID);
        $c->add(ThumbnailPeer::PARENT_ID,$this->getId());
        $c->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, ThumbnailPeer::SMALL);
        $image = ThumbnailPeer::doSelectOne($c);
        if($image)  {
            return '/images/'
                . sfConfig::get('app_thumbnails_web_dir')
                . '/' 
                . sfConfig::get('app_thumbnails_converted_dir_name') 
                . '/' 
                . $image->getPath() 
                . '/'
                . $image->getUuid()
    //            . '.'
    //            . $this->getMimeExtension()
            ;
        }
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
            . $this->getUuid();
//            . '.'
//            . $this->getMimeExtension();
        
    }

    public function generateUuidFilename($file) {
//      called from  sfValidatedFile 
//        $uuid = md5(time() + rand());

        $thumbnailMime = ThumbnailMimePeer::retrieveByMime($file->getType());
        $this->setMimeExtension($thumbnailMime->getExtension());
        $this->setMimeId($thumbnailMime->getId());

//        $file->save($uuid.'.'.$this->getMimeExtension());
//        $this->setUuid($uuid); 
//        return $uuid;
    }

    /**
    * Gets path to upload thumbnail.
    * 
    * @param  string $type
    * @return object
    * @author Andreas Nyholm
    * @access public
    */
    public function getUploadPath()
    {
        $thumbnailDir = sfConfig::get('app_thumbnails_original_dir_name');
        
        return sfConfig::get('sf_web_dir') 
            . DIRECTORY_SEPARATOR 
            . sfConfig::get('app_thumbnails_dir')
            . DIRECTORY_SEPARATOR 
            . $thumbnailDir
            . DIRECTORY_SEPARATOR 
            . $this->getPath(); 
        
    }    
}
