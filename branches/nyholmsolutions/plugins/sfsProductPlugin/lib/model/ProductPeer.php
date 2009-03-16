<?php

/**
 * Subclass for performing query and update operations on the 'products' table.
 *
 * 
 *
 * @package plugins.sfsProductPlugin.lib.model
 */ 
class ProductPeer extends BaseProductPeer
{
   /**
    * Get array with products by array with products $id.
    * 
    * @param  array $ids
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByIds($ids, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID, $ids, Criteria::IN);
        
        if ($withI18n) {
            return self::doSelectWithTranslation($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
    
   /**
    * Sets all products is deleted by $ids.
    * 
    * @param  array $ids
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function deleteByIds($ids)
    {
        $criteriaWhere = new Criteria();
        $criteriaWhere->add(self::ID, $ids, Criteria::IN);
        
        $criteriaSet = new Criteria();
        $criteriaSet->add(self::IS_DELETED, 1);
        
        BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
    }
    
   /**
    * Gets recent products.
    * 
    * @param  void
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getRecent()
    {
        $criteria = new Criteria();
        self::addPublicCriteria($criteria);
        CategoryPeer::addPublicCriteria($criteria);
        $criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, self::ID);
        $criteria->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);
        $criteria->setDistinct();
        $criteria->setLimit(sfConfig::get('app_product_max_recent', 5));
        $criteria->addDescendingOrderByColumn(self::CREATED_AT);
        return self::doSelectWithTranslation($criteria);
    }
}
