<?php

/**
 * Subclass for representing a row from the 'categories' table.
 *
 * 
 *
 * @package plugins.sfsCategoryPlugin.lib.model
 */ 
class sfsCategory extends BasesfsCategory
{
    protected $parentTreeArray = array();
    
    /**
     * Gets child categories for current category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk
     * @access public
     */
    public function getChildCategories($culture = null)
    {
        if ($culture == null) {
            $culture = sfContext::getInstance()->getUser()->getCulture();
        }
        
        if ($this->getHasChild()) {
            $criteria = new Criteria();
            $criteria->add(sfsCategoryPeer::IS_ACTIVE, sfsCategoryPeer::ACTIVE);
            $criteria->add(sfsCategoryPeer::PARENT_ID, $this->getId());
            $criteria->addAscendingOrderByColumn(sfsCategoryPeer::TITLE);
            return sfsCategoryPeer::doSelectWithI18n($criteria, $culture);
        }
        else {
            return null;
        }
    }
    
    public function getAllChildCategories(&$allChildCategories)
    {
        $categories = $this->getChildCategories();
        
        if (is_array($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                $allChildCategories[] = $category;
                $category->getAllChildCategories($allChildCategories);
            }
        }
    }
    
    /**
     * Returns array with parents series for current category.
     *
     * @param  void
     * @return array
     * @author Dmitry Nesteruk
     * @access public
     */
    public function getParentsSeries(&$array)
    {
        $id = $this->getParentId();
        
        if ($id == null) {
            $array = array_reverse($array);
            return $array;
        }
        
        $category = sfsCategoryPeer::retrieveByPK($id);
        
        if (is_object($category)) {
            $array[] = $category;
            $category->getParentsSeries($array);
        }
    }
    
    public function getLastParentCategoryId()
    {
        
        if (!empty($this->parentTreeArray)) {
            return $this->parentTreeArray[0]->getId();
        }
        
        $this->getParentTree();
        
        if (!empty($this->parentTreeArray)) {
            return $this->parentTreeArray[0]->getId();
        }
    }
}
