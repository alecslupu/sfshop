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
 * Base products actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.product
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseProductActions extends sfActions
{
  /**
   * Executes index action
   *
   */
    public function executeIndex()
    {
        $this->getUser()->getAttributeHolder()->removeNamespace('assets');
        $this->getUser()->getAttributeHolder()->removeNamespace('product');
        $this->getUser()->getAttributeHolder()->removeNamespace('product/filter');
        
        $this->redirect('@product_list');
    }
    
   /**
    * Gets products list.
    * 
    * If selected category, gets products list for current category.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeList($request)
    {
        if ($request->isMethod('post')) {
            $this->processFilter();
        }
        
        $this->filter = $this->getUser()->getAttributeHolder()->getAll('product/filter');
        
        $criteria = new Criteria();
        $this->addCategoryCriteria($criteria);
        $this->addSearchCriteria($criteria);
        $criteria = $this->addFilterCriteria($criteria);
        ProductPeer::addPublicCriteria($criteria);
        
        $this->pager = new sfPropelPager('Product', 10);
        $this->pager->setPeerMethod('doSelectWithTranslation');
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
    
   /**
    * Gets product details.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDetails()
    {
        sfLoader::loadHelpers('sfsCurrency');
        
        $criteria = new Criteria();
        ProductPeer::addPublicCriteria($criteria);
        $this->product = ProductPeer::retrieveById($this->getRequestParameter('id'), $criteria, true);
        $this->forward404Unless($this->product);
        
        $response = $this->getResponse();
        $response->addMeta('keywords', $this->product->getMetaKeywords(), true);
        $response->addMeta('description', $this->product->getMetaDescription(), true);
        
        $this->optionsForm = '';
        
        if ($this->product->getHasOptions()) {
            $this->optionsForm = new sfsProductOptionsForm($this->product);
        }
    }
    
   /**
    * Gets criteria for products list with selected category.
    * 
    * @param  $criteria
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    protected function addCategoryCriteria($criteria)
    {
        sfLoader::loadHelpers('sfsCategory');
        $categoryId = get_current_category_id();
        
        if ($categoryId != null) {
            $criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);
            $ids = CategoryPeer::getAllChildIds($categoryId);
            
            if ($ids !== null && count($ids) > 0) {
                $ids = array_merge($ids, array($categoryId));
                $criteria->add(Product2CategoryPeer::CATEGORY_ID, $ids, Criteria::IN);
            }
            else {
                $criteria->add(Product2CategoryPeer::CATEGORY_ID, $categoryId);
            }
        }
        
        return $criteria;
    }
    
    protected function addSearchCriteria($criteria)
    {
        $request = $this->getRequest();
        
        $this->formSearch = new sfsProductSearchForm();
        
        if ($request->hasParameter('data[query]')) {
            
            $data = $request->getParameter('data');
            $this->formSearch->bind($data);
            
            if ($this->formSearch->isValid()) {
                $queryString = $data['query'];
                $this->getUser()->setAttribute('query', $queryString, 'product');
            }
        }
        elseif ($request->hasParameter('is_search')) {
            $queryString = $this->getUser()->getAttribute('query', '', 'product');
            $this->formSearch->setDefault('query', $queryString);
        }
        
        if (isset($queryString)) {
            
            $this->isSearch = true;
            $this->queryString = $queryString;
            
            $searchCriteria = new xfCriterionPhrase($queryString, 2);
            $results = xfIndexManager::get('ProductSearchIndex')->find($searchCriteria);
            
            $ids = array();
            
            if (!empty($results) && is_object($results)) {
                foreach($results as $res) {
                    $ids[] = $res->getId();
                }
            }
            
            $criteria->add(ProductPeer::ID, $ids, Criteria::IN);
        }
    }
    
    protected function processFilter()
    {
        if ($this->hasRequestParameter('filter')) {
            $this->filter = $this->getRequestParameter('filters');
            
            if ($this->filter['brand_id'] == 'all') {
                unset($this->filter['brand_id']);
            }
            
            $this->getUser()->getAttributeHolder()->removeNamespace('product/filter');
            $this->getUser()->getAttributeHolder()->add($this->filter, 'product/filter');
        }
    }
    
    protected function addFilterCriteria($criteria)
    {
        if (isset($this->filter['brand_id']) && $this->filter['brand_id'] !== '') {
            $criteria->add(ProductPeer::BRAND_ID, $this->filter['brand_id']);
        }
        
        return $criteria;
    }
}

