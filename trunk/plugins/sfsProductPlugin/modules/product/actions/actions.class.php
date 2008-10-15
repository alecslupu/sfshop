<?php

/**
 * products actions.
 *
 * @package    sfShop
 * @subpackage product
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class productActions extends sfActions
{
  /**
   * Executes index action
   *
   */
    public function executeIndex()
    {
        $this->getUser()->getAttributeHolder()->removeNamespace('assets');
        $this->redirect('@products_list');
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
        $this->filter = $this->getUser()->getAttributeHolder()->getAll('product/filter');
        
        $this->formFilter = new sfsProductFilterForm();
        $brandForm = new sfsBrandFilterForm();
        
        $criteria = new Criteria();
        $this->addCategoryCriteria($criteria);
        $this->addSearchCriteria($criteria);
        
        //$this->formFilter->embedForm('brand', $brandForm);
        
        /*
        if ($request->isMethod('post')) {
            
            $this->formFilter->bind($request->getParameter('filters'));
            
            if ($this->formFilter->isValid()) {
                $this->processFilters();
            }
        }
        
        */
        if (isset($this->filter['brand']['brand_id'])) {
            $brandForm->getWidgetSchema()->offsetGet('brand_id')->setAttribute('selected', $this->filter['brand']['brand_id']);
            $brandForm->setDefault('brand_id', $this->filter['brand']['brand_id']);
        }
        
        $criteria = $this->addFiltersCriteria($criteria);
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
                $this->getUser()->setAttribute('query', $queryString, 'products');
            }
        }
        elseif($this->getUser()->getAttribute('query', null, 'products') != null) {
            $queryString = $this->getUser()->getAttribute('query', '', 'products');
        }
        
        if (isset($queryString)) {
            
            $this->isSearch = true;
            
            $query = new sfLuceneCriteria(sfLuceneToolkit::getApplicationInstance());
            
            $query->addSane($queryString);
            $results = sfLuceneToolkit::getApplicationInstance()->friendlyFind($query);
            
            $ids = array();
            
            if (!empty($results) && is_object($results)) {
                foreach($results as $res) {
                    $ids[] =  $res->getId();
                }
            }
            
            $criteria->add(ProductPeer::ID, $ids, Criteria::IN);
        }
    }
    
    protected function processFilters()
    {
        if ($this->hasRequestParameter('filter')) {
            $this->filter = $this->getRequestParameter('filter');
            $this->getUser()->getAttributeHolder()->removeNamespace('product/filter');
            $this->getUser()->getAttributeHolder()->add($this->filter, 'product/filter');
        }
    }
    
    protected function addFiltersCriteria($criteria)
    {
        
        if (isset($this->filter['brand']['brand_id']) && $this->filter['brand']['brand_id'] !== '') {
            $criteria->add(ProductPeer::BRAND_ID, $this->filter['brand']['brand_id']);
        }
        
        return $criteria;
    }
}

