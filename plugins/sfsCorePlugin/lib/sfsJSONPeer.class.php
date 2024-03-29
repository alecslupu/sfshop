<?php
/**
 * Enter description here...
 * 
 * @author     Andrey Kotlyarov
 * 
 */
class sfsJSONPeer
{
    const STATUS_ERROR = 1;
    const STATUS_SUCCESS = 2;

    public static function decode($json, $assoc = true)
    {
        //$json = addcslashes($json, "\n\r\t");
        return json_decode($json, $assoc);
    }
    
    
    
    public static function encode($arr)
    {
        return json_encode($arr);
    }
    
    
    
    public static function hasValue($json, $key, &$value)
    {
        $arr = self::decode($json, true);
        if (isset($arr[$key]))
        {
            $value = $arr[$key];
            return true;
        }
        else
        {
            $value = null;
            return false;
        }
    }
    
    
    
    public static function getValue($json, $key)
    {
        self::hasValue($json, $key, $value);
        return $value;
    }
    
    
    
    public static function update(&$jsonOld, $jsonNew)
    {
        $bChanged = false;
        $arrOld = self::decode($jsonOld, true);
        $arrNew = self::decode($jsonNew, true);
        
        foreach ($arrNew as $key => $value)
        {
            if (
                !isset($arrOld[$key])
                ||
                ($arrOld[$key] !== $value)
            )
            {
                $bChanged = true;
                $arrOld[$key] = $value;
            }
        }
        if ($bChanged)
        {
            $jsonOld = self::encode($arrOld);
        }
        return $bChanged;
    }
    
    
    
    public static function createResponseSuccess($data)
    {
        $result = array(
            'status' => self::STATUS_SUCCESS,
            'data'   => $data
        );
        return self::encode($result);
    }
    
    
    
    public static function createResponseError($errors = null)
    {
        if ($errors === null)
        {
            $errors = sfContext::getInstance()->getRequest()->getErrors();
        }
        $result = array(
            'status' => self::STATUS_ERROR,
            'errors' => $errors
        );
        return self::encode($result);
    }
    
    
    
}