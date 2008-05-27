<?php

/**
 * components.
 *
 * @package    sfShop
 * @subpackage core
 * @author     Dmitry Nesteruk
 */
class coreComponents extends sfComponents {

    public function executeLanguages()
    {
        $this->languages = sfsLanguagePeer::getAll();
    }
}
