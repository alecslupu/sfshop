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
    public function executeList()
    {
        $this->filter = $this->getUser()->getAttributeHolder()->getAll('product/filter');
        
        $this->form = new sfsProductFilterForm();
        $brandForm = new sfsBrandFilterForm();
        
        $criteria = new Criteria();
        $criteria = $this->getCategoryCriteria($criteria);
        
        if ($this->getRequest()->isMethod('post')) {
            
            $this->form->bind($this->getRequestParameter('filters'));
            
            if ($this->form->isValid()) {
                $this->processFilters();
            }
        }
        
        if (isset($this->filter['brand']['brand_id'])) {
            $brandForm->getWidgetSchema()->offsetGet('brand_id')->setAttribute('selected', $this->filter['brand']['brand_id']);
            $brandForm->setDefault('brand_id', $this->filter['brand']['brand_id']);
        }
        
        $this->form->embedForm('brand', $brandForm);
        
        $criteria = $this->addFiltersCriteria($criteria);
        ProductPeer::addPublicCriteria($criteria);
        
        $this->pager = new sfPropelPager('Product', 10);
        $this->pager->setPeerMethod('doSelectWithTranslation');
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
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
    protected function getCategoryCriteria($criteria)
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

