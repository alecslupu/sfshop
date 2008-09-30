<?php

/**
 * components.
 *
 * @package    sfShop
 * @subpackage core
 * @author     Dmitry Nesteruk
 */
class coreComponents extends sfComponents {

    public function executeSelectLanguage()
    {
        $criteria = new Criteria();
        LanguagePeer::addPublicCriteria($criteria);
        $this->languages = LanguagePeer::getAll($criteria);
    }
}
