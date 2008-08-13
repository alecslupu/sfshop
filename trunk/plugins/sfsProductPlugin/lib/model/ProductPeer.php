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
    * Get avaliable product with details by $id.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveByIdWithI18n($id, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID, $id);
        
        $result = self::doSelectWithTranslation($criteria);
        
        if (!$result) {
            return null;
        }
        else {
            return $result[0];
        }
    }
    
   /**
    * Get product object by $id.
    * 
    * @param  int $id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById($id, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID, $id);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Get array with products by array with products $id.
    * 
    * @param  array $ids
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function getByIdsWithI18n($ids)
    {
        $criteria = new Criteria();
        $criteria->add(self::ID, $ids, Criteria::IN);
        return self::doSelectWithTranslation($criteria);
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
        $criteria->setLimit(sfConfig::get('app_product_max_recent', 5));
        $criteria->addDescendingOrderByColumn(self::CREATED_AT);
        return self::doSelectWithTranslation($criteria);
    }
}
