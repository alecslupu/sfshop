<?php

/**
 * 
 *
 * @package    sfsCorePlugin
 * @author     Andrey Kotlyarov
 */
class sfsDebug
{
    protected static $messageFile = '/tmp/grand-debug.mes';
    
    
    public static function writeMessage($message)
    {
        $fh = fopen(self::$messageFile, 'a');
        fwrite($fh, '[' . date('H:i:s') . ']: ' . $message . "\n");
        fclose($fh);
    }
    
    
   
}