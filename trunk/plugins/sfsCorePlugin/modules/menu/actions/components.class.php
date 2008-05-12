<?php

/**
 * Menu components.
 *
 * @package    plugins.sfsCorePlugin
 * @subpackage core
 * @author     Dmitry Nesteruk
 */
class menuComponents extends sfComponents
{
    
    /**
    * Gets items for main menu.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeMain()
    {
        $this->items = sfsMenuPeer::getItemsByType(sfsMenuPeer::TYPE_MAIN, $this->getUser()->getCulture());
    }
    
    /**
    * Gets items for menu in the member profile.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeProfile()
    {
        $this->items = sfsMenuPeer::getItemsByType(sfsMenuPeer::TYPE_PROFILE, $this->getUser()->getCulture());
    }
}
