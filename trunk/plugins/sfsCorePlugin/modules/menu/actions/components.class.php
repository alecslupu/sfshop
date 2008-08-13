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
        $this->items = MenuPeer::getItemsByType(MenuPeer::TYPE_MAIN);
    }
    
    public function executeTop()
    {
        $this->items = MenuPeer::getItemsByType(MenuPeer::TYPE_TOP);
    }
    
    public function executeBottom()
    {
        $this->items = MenuPeer::getItemsByType(MenuPeer::TYPE_BOTTOM);
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
        $this->items = MenuPeer::getItemsByType(MenuPeer::TYPE_PROFILE);
    }
}
