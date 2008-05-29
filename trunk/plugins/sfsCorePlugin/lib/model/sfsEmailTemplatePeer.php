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
    public static function retrieveByName($name)
    {
        $criteria = new Criteria();
        $criteria->add(self::NAME, $name);
        $criteria->setLimit(1);
        
        $objects = self::doSelectWithTranslation($criteria);
        
        if ($objects) {
            return $objects[0];
        }
        else {
            if ($template == null) {
                throw new sfStorageException(sprintf('The template with name "%s" does not exist, you should add this template to database', $name));
            }
        }
        
        return null;
    }
}
