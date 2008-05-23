<?php

/**
 * categories components.
 *
 * @package    plugins.sfsCategoryPlugin.modules
 * @subpackage categories
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoriesComponents extends sfComponents 
{
    public function executeMenuTree()
    {
        $this->categories = sfsCategoryPeer::getFirstLevel();
        $this->currentCategoryId = 0;
        
        if ($this->hasRequestParameter('cPath')) {
            $c = explode(sfConfig::get('app_categories_url_separator', '_'), $this->getRequestParameter('cPath'));
            $this->currentCategoryId = $c[count($c)-1];
            
            $currentCategory = sfsCategoryPeer::retrieveByPK($this->currentCategoryId);
            
            if (is_object($currentCategory)) {
                $this->parentTree = array();
                
                $currentCategory->getParentsSeries($this->parentTree);
                /*
                $categories = array();
                
                if (!empty($parentCategories)) {
                    foreach ($parentCategories as $category) {
                        $categories[] = $category->getId();
                    }
                    
                    $this->parentTree = array_values($categories);
                }*/
            }
        }
    }
}
