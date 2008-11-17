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
 * Categories components.
 *
 * @package    plugins.sfsCategoryPlugin
 * @subpackage modules.category
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoryComponents extends sfComponents 
{
   /**
    * Draws categories tree.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeMenuTree()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $request = $this->getRequest();
        $this->categories = CategoryPeer::getFirstLevel();
        $this->currentCategoryId = 0;
        
        $this->parentTree = array();
        
        if ($request->hasParameter('path')) {
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
        
        if ($request->hasParameter('is_search')) {
            $this->itemRouting = '@product_search';
        }
        else {
            $this->itemRouting = '@product_list';
        }
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
