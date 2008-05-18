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
    const REGISTRATION    = 'REGISTRATION';
    const FORGOT_PASSWORD = 'FORGOT_PASSWORD';
    const RECONFIRM_EMAIL = 'RECONFIRM_EMAIL';
    
    /**
    * Gets email template with body and subject by tamplate name and culture.
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
        $objects = self::doSelectWithI18n($criteria, $culture);
        
        if ($objects) {
            return $objects[0];
        }
        return null;
    }
}
