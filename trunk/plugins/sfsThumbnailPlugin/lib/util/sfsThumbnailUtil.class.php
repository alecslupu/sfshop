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
    public static function mkdirTree($path, $rights=0775)
    {
        $dirs = explode('/', $path);
        $dir = array_shift($dirs);
        foreach ($dirs as $subdir)
        {
            $dir .= '/'.$subdir;
            if (!file_exists($dir))
                if (!mkdir($dir, $rights))
                    return false;
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
       if ($dir)
       {
         while ($item=$dir->read()) {
             if (preg_match('/^(\.+)$/',$item)) {
             }
             elseif (is_file($path.$item)) {
                 @unlink($path.$item);
             }
             elseif (is_dir($path.$item)) {
                 self::rmdirtree($path.$item);
             }
         }
         $dir->close();
       }
        
       @rmdir($path);
    }
}
?>