<?php

/**
 * categories components.
 *
 * @package    plugins.sfsCategoryPlugin.modules
 * @subpackage categories
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoryComponents extends sfComponents 
{
    public function executeMenuTree()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $this->categories = CategoryPeer::getFirstLevel();
        $this->currentCategoryId = 0;
        
        $this->parentTree = array();
        
        if ($this->hasRequestParameter('path')) {
            $this->currentCategoryId = get_current_category_id();
            
            $currentCategory = CategoryPeer::retrieveByPK($this->currentCategoryId);
            
            $controller = $this->getController();
            $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->forward404Unless($currentCategory);
            
            $response = $this->getResponse();
            $response->addMeta('keywords', $currentCategory->getMetaKeywords(), true);
            $response->addMeta('description', $currentCategory->getMetaDescription(), true);
            
            if ($currentCategory !== null) {
                $currentCategory->getParentsSeries($this->parentTree);
                $this->parentTree = array_merge($this->parentTree, array($currentCategory));
            }
        }
    }
    
    /**
    * Gets current category, draw header for product list.
    * 
    * @param  $criteria
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeHeaderProductList()
    {
        sfLoader::loadHelpers('sfsCategory');
        $categoryId = get_current_category_id();
        
        $this->category = CategoryPeer::retrieveByPK($categoryId);
        
        if ($this->category !== null) {
            $response = $this->getResponse();
            $response->addMeta('keywords', $this->category->getMetaKeywords(), true);
            $response->addMeta('description', $this->category->getMetaDescription(), true);
        }
    }
}
