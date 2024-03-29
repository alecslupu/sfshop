<?php

/**
 * Class extends basic user class
 *
 * @package    sfShop
 * @author     Dmitry Nesteruk, Andrey Kotlyarov
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfsBackendSecurityUser extends sfsSecurityUser
{
    protected $model = 'admin';
    protected $menu     = null;
    protected $menuItem = null;

    public function setCulture($culture)
    {
      if ($culture == 'admin')
      {
        $culture = LanguagePeer::getDefault();
        $culture = $culture->getCulture();
      }
      parent::setCulture($culture);
    }
    
    public function init($isForced = false)
    {
        parent::init($isForced);
        
        $module = sfContext::getInstance()->getRequest()->getParameter('module');
        $action = sfContext::getInstance()->getRequest()->getParameter('action');
        $current_id = null;
        $root_id    = null;
        
        $this->menuItem = AdminMenuPeer::getItem($module, $action);

        if ($this->menuItem !== null) {
            //$root = $item->getAdminMenuRelatedByParentId();
            $current_id = $this->menuItem->getId();
            $root_id    = $this->menuItem->getParentId();
        }
        
        $menu = AdminMenuPeer::getItems(null, $this->getCulture());
        $items = array();
        for ($i = 0; $i < count($menu); $i++) {
            $submenu = AdminMenuPeer::getItems($menu[$i]->getId(), $this->getCulture());
            $subitems = array();
            $menu_current = False;
            for ($j = 0; $j < count($submenu); $j++) {

                if ($this->isAccess($submenu[$j])) {
                    $subitem = array();
                    $subitem['title'] = $submenu[$j]->getTitle();
                    $subitem['route'] = '@' . $submenu[$j]->getRoute();
                    $subitem['is_current'] = ($submenu[$j]->getId() === $current_id);
                    if ($subitem['is_current']) $menu_current = True;
                    $subitems[] = $subitem;
                }
            }
            if (count($subitems) > 0) {
                $item = array();
                $item['title'] = $menu[$i]->getTitle();
                $item['route'] = $subitems[0]['route'];
                $item['is_current'] = ($menu[$i]->getId() === $root_id or $menu[$i]->getId() === $current_id or $menu_current);
                $item['subitems'] = $subitems;
                $items[] = $item;
            }
        }
        
        $this->menu = $items;
        
    }
    
    
    
    public function getMenu()
    {
        return $this->menu;
    }
    
    public function getMenuItem()
    {
        return $this->menuItem;
    }
    
    
    
    protected function isAccess($menuItem)
    {
        foreach (explode(',', $menuItem->getCredential()) as $credential) {
            $credential = preg_replace("/(\s+$|^\s+)/", '', $credential);
            
            if ($credential != '' && $this->hasCredential($credential)) {
                return true;
            }
        }
        
        return false;
    }
}
