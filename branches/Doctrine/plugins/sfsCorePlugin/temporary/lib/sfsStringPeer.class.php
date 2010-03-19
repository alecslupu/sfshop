<?php
/**
 * Enter description here...
 * 
 * @author     Andrey Kotlyarov
 * 
 */
class sfsStringPeer
{
    public static function special($str)
    {
        $res = $str;
        $res = htmlspecialchars($res);
        
        return $res;
    }
    
    public static function crypt($str, $algorithm = '')
    {
        if ($algorithm == '')
        {
            $algorithm = sfConfig::get('app_crypt_algorithm', 'md5');
        }
        
        $res = $str;
        switch ($algorithm)
        {
            case 'md5':
                $res = md5($res);
                break;
            case 'sha1':
                $res = sha1($res);
                break;
            default:
                // Exeption
                break;
        }
        return $res;
    }
    
    public static function strip_tags($str)
    {
        $res = $str;
        $res = strip_tags($res);
        
        return $res;
    }
    
    public static function br2nl($str)
    {
        $res = $str;
        $res = preg_replace("/<br[^>]*>/i", "\n", $res);
        
        return $res;
    }
    
    public static function truncate($str, $len)
    {
        $res = $str;
        $res = substr($res, 0, $len);
        
        return $res;
    }
}
