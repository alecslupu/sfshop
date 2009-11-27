<?php

/**
 * Subclass for performing query and update operations on the 'brand' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class BrandPeer extends BaseBrandPeer
{
   /**
    * Get brands used in current category and its children
    * If no current category, get all brands
    * 
    * @param  void
    * @return array
    * @author Andreas Nyholm andreas.nyholm@nyholmsolutions.fi
    * @access public
    */
    public static function getBrandsFromCurrentCategory()
    {
        sfLoader::loadHelpers('sfsCategory');
        $categoryId = get_current_category_id();
        if(!$categoryId)
          return BrandPeer::getAll(new Criteria(), true);
        $criteria = new Criteria();
        $ah =  sfContext::getInstance()->getUser()->getAttributeHolder()->getAll('product/filter');
        $cton2 = null;
        if(isset($ah['brand_id'])) {
          $cton2 = $criteria->getNewCriterion(BrandPeer::ID, $ah['brand_id']);
        }
        $criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);
        $ids = CategoryPeer::getAllChildIds($categoryId);

        $ids = array_merge($ids, array($categoryId));
        if($cton2) {
            $cton1 = $criteria->getNewCriterion(Product2CategoryPeer::CATEGORY_ID, $ids, Criteria::IN);
            $cton1->addOr($cton2);
            $criteria->add($cton1);
        }
        else 
            $criteria->add(Product2CategoryPeer::CATEGORY_ID, $ids, Criteria::IN);
            
        $criteria->addJoin(ProductPeer::BRAND_ID, BrandPeer::ID);
        $criteria->setDistinct();
        $criteria->add(ProductPeer::IS_ACTIVE, 1);
        $criteria->add(ProductPeer::IS_DELETED, 0);
        $criteria->add(CategoryPeer::IS_ACTIVE, 1);
        $criteria->add(CategoryPeer::IS_DELETED, 0);
        return BrandPeer::doSelectWithTranslation($criteria);
    }
  
}