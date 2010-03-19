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
    * Gets records with i18n. But if records for current cultures does not exist, 
    * the function will return records with i18n for default culture.
    * 
    * @param  $criteria
    * @param  $culture
    * @param  $con
    * @return array with objects
    * @author Sebastien HEITZMANN
    * @access public
    */
    public static function doSelectWithTranslation(Criteria $c, $culture = null, $con = null)
    {
        $results = self::doSelectWithI18n($c, $culture, $con);
        
        if ($results == null) {
            $defaultCulture = LanguagePeer::getDefault();
            $results = self::doSelectWithI18n($c, $defaultCulture->getCulture());
        }
        
        return $results;
    }

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
