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
            \$defaultCulture = sfsLanguagePeer::getDefault();
            \$results = self::doSelectWithI18n(\$c, \$defaultCulture->getCulture());
        }
        
        return \$results;
    }
";
    }
    
    /**
     * Closes class.
     * @param string &$script The script will be modified in this method.
     */ 
    protected function addClassClose(&$script)
    {
        if ($this->getTable()->getAttribute('isI18n')) {
            $this->addDoSelectWithTranslation($script);
        }
        parent::addClassClose($script);
    }
}

