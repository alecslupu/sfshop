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
 * Base categories components.
 *
 * @package    plugins.sfsCategoryPlugin
 * @subpackage modules.category
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseCategoryComponents extends sfComponents 
{
   /**
    * Draws categories tree.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeMenuTree()
    {
		$this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        
        $request = $this->getRequest();
        $this->categories = CategoryPeer::getFirstLevel();
        $this->currentCategoryId = 0;
        
        $parentTree = array();
        
        if ($request->hasParameter('path') && $request->getParameter('path')) {
            $this->currentCategoryId = get_current_category_id();
            
            $currentCategory = CategoryPeer::retrieveById($this->currentCategoryId);
            
            $controller = $this->getController();
            $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->forward404Unless($currentCategory);
            
            $response = $this->getResponse();
            $response->addMeta('keywords', $currentCategory->getMetaKeywords(), true);
            $response->addMeta('description', $currentCategory->getMetaDescription(), true);
            
            if ($currentCategory !== null) {
                $currentCategory->getParentsSeries($parentTree);
                $parentTree = array_merge($parentTree, array($currentCategory));
            }
        }
        
        $this->itemRouting = '@product_list';
        $this->parentTree = $parentTree;
    }
    
   /**
    * Draws header for product list.
    * 
    * @param  $criteria
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeHeaderProductList()
    {
		$this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        $categoryId = get_current_category_id();
        
        $this->category = CategoryPeer::retrieveById($categoryId);
        
        if ($this->category !== null) {
            $response = $this->getResponse();
            $response->addMeta('keywords', $this->category->getMetaKeywords(), true);
            $response->addMeta('description', $this->category->getMetaDescription(), true);
        }
    }
}
