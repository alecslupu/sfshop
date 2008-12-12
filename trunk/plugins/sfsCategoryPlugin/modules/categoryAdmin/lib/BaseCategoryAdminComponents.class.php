<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Base categories admin components.
 *
 * @package    plugins.sfsCategoryPlugin
 * @subpackage modules.categoriesAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseCategoryAdminComponents extends sfComponents
{
   /**
    * Draws categories tree.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeTree()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $this->parentTree = array();
        
        if ($this->hasRequestParameter('path')) {
            $this->currentCategoryId = get_current_category_id();
            
            $criteria = new Criteria();
            CategoryPeer::addAdminCriteria($criteria);
            $currentCategory = CategoryPeer::retrieveById($id, $criteria, true);
            
            $controller = $this->getController();
            $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->forward404Unless($currentCategory);
            
            $currentCategory->getParentsSeries($this->parentTree);
            $this->parentTree = array_merge($this->parentTree, array($currentCategory));
        }
    }
    
   /**
    * Draws list of all categories.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
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
