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
        
        
        
        $menu = AdminMenuPeer::getItems(null);
        $items = array();
        for ($i = 0; $i < count($menu); $i++) {
            $submenu = AdminMenuPeer::getItems($menu[$i]->getId());
            $subitems = array();
            for ($j = 0; $j < count($submenu); $j++) {
                if ($this->isAccess($submenu[$j])) {
                    $subitem = array();
                    $subitem['title'] = $submenu[$j]->getTitle();
                    $subitem['route'] = '@' . $submenu[$j]->getRoute();
                    $subitem['is_current'] = ($submenu[$j]->getId() === $current_id);
                    $subitems[] = $subitem;
                }
            }
            if (count($subitems) > 0) {
                $item = array();
                $item['title'] = $menu[$i]->getTitle();
                $item['route'] = $subitems[0]['route'];
                $item['is_current'] = ($menu[$i]->getId() === $root_id);
                $item['subitems'] = $subitems;
                $items[] = $item;
            }
        }
        
        /*
        echo '<pre>';
        print_r($items);
        exit;
        */
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
