<?php

/**
 * This class is an extension to the Symfony Peer Builder, which is itself an extension
 * to the Propel peer builder class.  
 *
 * @package plugins.sfsCorePlugin.lib
 * @author  Dmitry Nesteruk
 * @version $Id:$
 **/

class sfsPeerBuilder extends SfPeerBuilder
{

    protected function addDoSelectWithTranslation(&$script)
    {
    $script .= "
   /**
    * Gets records with i18n. But if records for current cultures does not exist, 
    * the function will return records with i18n for default culture.
    * 
    * @param  \$criteria
    * @param  \$culture
    * @param  \$con
    * @return array with objects
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function doSelectWithTranslation(Criteria \$c, \$culture = null, \$con = null)
    {
        \$results = self::doSelectWithI18n(\$c, \$culture, \$con);
        
        if (\$results == null) {
            \$defaultCulture = LanguagePeer::getDefault();
            \$results = self::doSelectWithI18n(\$c, \$defaultCulture->getCulture());
        }
        
        return \$results;
    }
";
    }
    
    protected function addAddPublicCriteria(&$script)
    {
    $script .="
   /**
    * Gets public criteria.
    * 
    * @param  \$criteria
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    
    public static function addPublicCriteria(Criteria \$criteria)
    {
        self::addAdminCriteria(\$criteria);
        ";
    if ($this->getTable()->getColumn('is_active')) {
    $script .="
        \$criteria->addAnd(self::IS_ACTIVE, 1);
    ";
    }
    $script .="
    }
    
    ";
    }
    
    protected function addAddAdminCriteria(&$script)
    {
    $script .="
   /**
    * Gets admin criteria.
    * 
    * @param  \$criteria
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    
    public static function addAdminCriteria(Criteria \$criteria)
    {";
    if ($this->getTable()->getColumn('is_deleted')) {
    $script .="
        \$criteria->addAnd(self::IS_DELETED, 0);
    ";
    }
    $script .="
    }
    
    ";
    }
    
    protected function addGetById(&$script)
    {
    $script .= "
   /**
    * Get object by \$id.
    * 
    * @param  int \$id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById(\$id, \$criteria = null, \$withI18n = false)
    {
        if (\$criteria == null) {
            \$criteria = new Criteria();
        }
        
        \$criteria->add(self::ID, \$id);
        
        if (\$withI18n) {
            \$criteria->setLimit(1);
            list(\$object) = self::doSelectWithI18n(\$criteria);
            return \$object;
        }
        else {
            return self::doSelectOne(\$criteria);
        }
    }
    ";
    }
    
    protected function addGetAllI18n(&$script)
    {
    $script .= "
   /**
    * Gets all records.
    * 
    * @param  \$criteria
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll(\$criteria = null, \$withI18n = false)
    {
        if (\$criteria == null) {
            \$criteria = new Criteria();
        }
        
        if (\$withI18n) {
            return self::doSelectWithI18n(\$criteria);
        }
        else {
            return self::doSelect(\$criteria);
        }
    }
    ";
    }
    
    protected function addGetAll(&$script)
    {
    $script .= "
   /**
    * Gets all records.
    * 
    * @param  \$criteria
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getAll(\$criteria = null)
    {
        if (\$criteria == null) {
            \$criteria = new Criteria();
        }
        
        return self::doSelect(\$criteria);
    }
    ";
    }
    
    /**
     * Closes class.
     * @param string &$script The script will be modified in this method.
     */ 
    protected function addClassClose(&$script)
    {
        if ($this->getTable()->getColumn('is_active') || $this->getTable()->getColumn('is_deleted')) {
            $this->addAddAdminCriteria($script);
            $this->addAddPublicCriteria($script);
        }
        
        if ($this->getTable()->getColumn('id')) {
            $this->addGetById($script);
        }
        
        if ($this->getTable()->getAttribute('isI18n')) {
            $this->addGetAllI18n($script);
            $this->addDoSelectWithTranslation($script);
        }
        else {
            $this->addGetAll($script);
        }
        
        parent::addClassClose($script);
    }
}

