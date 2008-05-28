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
        
        $criteria = AssetPeer::getPublicCriteria($criteria);

        $criteriaSimple = clone $criteria;

        $criteriaSimple->add(AssetPeer::TYPE, AssetPeer::SIMPLE);

        $this->pager = new sfPropelPager('Asset', 10);
        $this->pager->setPeerMethod('doSelectJoinMember');
        $this->pager->setCriteria($criteriaSimple);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();

        if ($this->getRequestParameter('page', 1) != 1) {
            $criteria->setOffset(5 * $this->getRequestParameter('page') - 5);
        }

        $criteria->setLimit(5);
        $criteria->add(AssetPeer::TYPE, AssetPeer::BANNER);
        $count = AssetPeer::doCount($criteria);

        if ($count > 0) {
            $this->bannerAssets = AssetPeer::doSelect($criteria);
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
        
        if ($categoryId = getCurrentCategoryId()) {
            $criteria->addJoin(sfsProducts2CategoriesPeer::CATEGORY_ID, $category_id);
            $criteria->addJoin(AssetPeer::CATEGORY_ID, $category_id);
            
            $cache = new sfArrayCache(sfConfig::get('app_dirs_categories_cache', 'categories'));
            
            $ids = $cache->get('child_categories', $category_id);
            
            if ($ids === null) {
                       $category = CategoryPeer::retrieveByPK($category_id);

                        if (is_object($category)) {
                            $childCategories = array();
                            $category->getAllChildCategories($childCategories);

                            $ids = array();

                            if (is_array($childCategories) && !empty($childCategories)) {
                                 $ids[] = $category_id;

                                 foreach ($childCategories as $child) {
                                    $ids[]= $child->getId();
                                 }

                                $cache->setLifeTime(sfConfig::get('app_life_time_categories_array_with_child'));
                                $cache->set('child_categories', $category_id, $ids);
                            }
                        }
                    }
            
            }

        if (isset($ids) && is_array($ids) && !empty($ids)) {
            $criteria->add(AssetPeer::CATEGORY_ID, $ids, Criteria::IN);
        }
        return $criteria;
    }
}
