<?php

/**
 * products actions.
 *
 * @package    sfShop
 * @subpackage products
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class productsActions extends sfActions
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
        
        $criteria = new Criteria();
        
        $criteria = $this->getCategoryCriteria($criteria);
        //$criteria = $this->getSearchCriteria($criteria);
        //$criteria = $this->getTagCriteria($criteria);
        
        $criteria = sfsProductPeer::getPublicCriteria($criteria);
        
        $this->pager = new sfPropelPager('sfsProduct', 10);
        $this->pager->setPeerMethod('doSelect');
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();
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
        $categoryId = getCurrentCategoryId();
        
        if ($categoryId != null) {
            $criteria->addJoin(sfsProduct2CategoryPeer::PRODUCT_ID, sfsProductPeer::ID);
            $ids = sfsCategoryPeer::getAllChildIds($categoryId);
            
            if ($ids !== null && !empty($ids)) {
                $criteria->add(sfsProduct2CategoryPeer::CATEGORY_ID, $ids, Criteria::IN);
            }
            else {
                $criteria->add(sfsProduct2CategoryPeer::CATEGORY_ID, $categoryId);
            }
        }
        
        return $criteria;
    }
}
