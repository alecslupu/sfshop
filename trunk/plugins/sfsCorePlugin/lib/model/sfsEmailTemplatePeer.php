<?php

/**
 * Subclass for performing query and update operations on the 'email_template' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class sfsEmailTemplatePeer extends BasesfsEmailTemplatePeer
{
    const REGISTRATION = 'REGISTRATION';
    
    /**
    * Gets email template with body and subject.
    *
    * @param  string $name
    * @return mixed if template exist returns object, otherwise null.
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getTemplate($name, $culture)
    {
        $criteria = new Criteria();
        $criteria->add(self::NAME, $name);
        $object = self::doSelectWithI18n($criteria, $culture);
        
        if ($objects) {
            return $objects[0];
        }
        return null;
    }
}
