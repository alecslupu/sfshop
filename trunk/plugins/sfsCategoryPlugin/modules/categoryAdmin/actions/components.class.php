<?php

/**
 * categories components.
 *
 * @package    plugins.sfsCategoryPlugin.modules
 * @subpackage categoriesAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoryAdminComponents extends sfComponents 
{
    public function executeTree()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $this->parentTree = array();
        
        if ($this->hasRequestParameter('path')) {
            $this->currentCategoryId = get_current_category_id();
            
            $criteria = new Criteria();
            CategoryPeer::addAdminCriteria($criteria);
            $currentCategory = CategoryPeer::retrieveByIdWithI18n($id, $criteria);
            
            $controller = $this->getController();
            $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->forward404Unless($currentCategory);
            
            $currentCategory->getParentsSeries($this->parentTree);
            $this->parentTree = array_merge($this->parentTree, array($currentCategory));
        }
    }
    
    public function executeList()
    {
        sfLoader::loadHelpers(array('sfsCategory', 'Url'));
        
        $request = $this->getRequest();
        
        if (!$request->hasParameter('path')) {
            $criteria = new Criteria();
            CategoryPeer::addAdminCriteria($criteria);
            $this->categories = CategoryPeer::getFirstLevel($criteria);
        }
        else {
            $id = get_current_category_id();
            $criteria = new Criteria();
            CategoryPeer::addAdminCriteria($criteria);
            $this->currentCategory = CategoryPeer::retrieveById($id, clone $criteria);
            
            $this->parentCategory = $this->currentCategory->getCategoryRelatedByParentId();
            
            $controller = $this->getController();
            $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->forward404Unless($this->currentCategory);
            
            $this->categories = $this->currentCategory->getChild($criteria);
        }
    }
}
