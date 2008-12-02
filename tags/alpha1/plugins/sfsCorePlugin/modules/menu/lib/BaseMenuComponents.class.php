<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Base menu components.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.core
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseMenuComponents extends sfComponents
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
