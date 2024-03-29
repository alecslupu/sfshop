<?php

class sfsThumbnailUtil
{
   /**
    * Build dir tree
    *
    * @param  string $path path for creation
    * @param  int $rights rights for folders
    * @return bool true if success or false if fail
    * @access public
    */
    public static function mkdirTree($path, $rights = 0775)
    {
        $dirs = explode('/', $path);
        $dir = array_shift($dirs);
        foreach ($dirs as $subdir)
        {
            $dir .= '/'.$subdir;
            if (!file_exists($dir)) {
                if (!mkdir($dir, $rights)) {
                    return false;
                }
            }
        }
        return true;
    }
    
   /**
    * Remove dir tree
    *
    * @param  string $path path for remove
    * @return void
    * @access public
    */
    public static function rmdirTree($path)
    {
       if (!is_dir($path)) return;
        
       $path = rtrim($path,'/').'/';
       $dir  = @dir($path);
       
       if ($dir) {
         while ($item = $dir->read()) {
             if (preg_match('/^(\.+)$/', $item)) {
             }
             elseif (is_file($path . $item)) {
                 @unlink($path . $item);
             }
             elseif (is_dir($path . $item)) {
                 self::rmdirtree($path . $item);
             }
         }
         $dir->close();
       }
        
       @rmdir($path);
    }
    
   /**
    * Remove file.
    *
    * @param  string $file
    * @return void
    * @access public
    */
    public static function unlink($file)
    {
        @unlink($file);
    }
    
   /**
    * Save file on storage.
    *
    * @param  string $fileName
    * @param  string $path
    * @return void
    * @access public
    */
    public static function uploadFile($fileName, $path)
    {
        $request = sfContext::getInstance()->getRequest();
        
        if (!$request->hasFileError($fileName))
        {
            $fileMime = $request->getFileType($fileName);
            
            $array = explode(DIRECTORY_SEPARATOR, $path);
            unset($array[count($array)-1]);
            $thumbDir = implode(DIRECTORY_SEPARATOR, $array);
            
            if (!is_dir($thumbDir)) {
                self::mkdirTree($thumbDir);
            }
            
            $fileExtension = $request->getFileExtension($fileName);
            
            $request->moveFile($fileName, $path . str_replace('.', '', $fileExtension));
            
            return array(
                'extension' => $fileExtension,
                'mime'      => $fileMime
            );
        }
        
        return null;
    }
    
  /**
   * Gets all unconverted thumbnails and do convertaition.
   *
   * @param  void
   * @return void
   * @access public
   */
    public static function convert()
    {
        $thumbnails = ThumbnailPeer::getUnconverted();
        
        if ($thumbnails) {
            foreach ($thumbnails as $thumbnail) {
                $originalThumbnail = ThumbnailPeer::retrieveByPK($thumbnail->getParentId());
                
                if ($originalThumbnail !== null) {
                    $array = explode(DIRECTORY_SEPARATOR, $thumbnail->getStoragePath());
                    unset($array[count($array)-1]);
                    $thumbDir = implode(DIRECTORY_SEPARATOR, $array);
                    
                    if (!is_dir($thumbDir)) {
                        sfsThumbnailUtil::mkdirTree($thumbDir);
                    }
                    $thumbnail->setMimeId($originalThumbnail->getMimeId());
                    $thumbnail->setIsConverted(true);
                    $thumbnail->save();
                    
                    $thumb = new sfThumbnail($thumbnail->getThumbnailTypeAssetType()->getWidth(), $thumbnail->getThumbnailTypeAssetType()->getHeight(), true, true, 75, 'sfGDAdapter');
                    try 
                    {
                        $thumb->loadFile($originalThumbnail->getStoragePath());
                        $thumb->save($thumbnail->getStoragePath(), $thumbnail->getThumbnailMime()->getMime());
                    
                        ProjectConfiguration::getActive()->getEventDispatcher()->notify(new sfEvent($thumbnail, 'application.log', array(
                            sprintf('successfully converted %s (result: %s)', $thumbnail->getId(), $thumbnail->getStoragePath())
                        )));
                    }
                    catch(Exception $e)
                    {
                        ProjectConfiguration::getActive()->getEventDispatcher()->notify(new sfEvent($thumbnail, 'application.log', array(
                            sprintf('Unable to convert %s: %s', $thumbnail->getId(), $e->getMessage())
                        )));
                    }
                }
                else
                {
                    ProjectConfiguration::getActive()->getEventDispatcher()->notify(new sfEvent($thumbnail, 'application.log', array(
                        sprintf('Could not find original of %s', $thumbnail->getId())
                    )));
                }
            }
        }
        else 
        {
            ProjectConfiguration::getActive()->getEventDispatcher()->notify(new sfEvent($thumbnails, 'application.log', array(
                'No unconverted thumbnails'
            )));
        }
    }
}
?>