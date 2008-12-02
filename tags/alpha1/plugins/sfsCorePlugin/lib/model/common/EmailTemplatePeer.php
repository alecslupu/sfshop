<?php

/**
 * Subclass for performing query and update operations on the 'email_template' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class EmailTemplatePeer extends BaseEmailTemplatePeer
{
    const REGISTRATION    = 'REGISTRATION';
    const FORGOT_PASSWORD = 'FORGOT_PASSWORD';
    const RECONFIRM_EMAIL = 'RECONFIRM_EMAIL';
    const NEW_ADMIN_ADDED = 'NEW_ADMIN_ADDED';
    const RESET_PASSWORD  = 'RESET_PASSWORD';
    
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
        
        throw new PropelException('The email template with name ' . $name . ' was not found.');
    }
}
