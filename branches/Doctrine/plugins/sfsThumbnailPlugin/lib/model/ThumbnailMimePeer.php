<?php

/**
 * Subclass for performing query and update operations on the 'thumbnails_mime' table.
 *
 * 
 *
 * @package plugins.sfsThumbnailPlugin.lib.model
 */ 
class ThumbnailMimePeer extends BaseThumbnailMimePeer
{
   /**
    * Gets thumbnail mime object by $mime.
    * 
    * @param  string $mime
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByMime($mime)
    {
        $criteria = new Criteria();
        $criteria->add(self::MIME, $mime);
        return self::doSelectOne($criteria);
    }
}
