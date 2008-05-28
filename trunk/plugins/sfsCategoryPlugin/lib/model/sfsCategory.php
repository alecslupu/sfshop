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
    public function getChild()
    {
        $culture = sfContext::getInstance()->getUser()->getCulture();
        
        if ($this->getHasChild()) {
            $criteria = new Criteria();
            $criteria->add(sfsCategoryPeer::IS_ACTIVE, 1);
            $criteria->add(sfsCategoryPeer::PARENT_ID, $this->getId());
            $criteria->addAscendingOrderByColumn(sfsCategoryI18nPeer::TITLE);
            return sfsCategoryPeer::doSelectWithI18n($criteria, $culture);
        }
        else {
            return null;
        }
    }
    
    /**
    * Recursive function for gets all child categories.
    * 
    * @param  &$childCategories
    * @return null
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getChildSeries(&$childCategories)
    {
        $categories = $this->getChild();
        
        if ($categories != null) {
            foreach ($categories as $category) {
                $childCategories[] = $category;
                $category->getChildSeries($childCategories);
            }
        }
        else {
            return null;
        }
    }
    
    /**
     * Returns array with parents series for current category.
     *
     * @param  &$array
     * @return array
     * @author Dmitry Nesteruk
     * @access public
     */
    public function getParentsSeries(&$array)
    {
        $id = $this->getParentId();
        
        if (empty($array)) {
            $array[] = $this;
        }
        
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
    /*
    public function getLastParentCategoryId()
    {
        
        if (!empty($this->parentTreeArray)) {
            return $this->parentTreeArray[0]->getId();
        }
        
        $this->getParentTree();
        
        if (!empty($this->parentTreeArray)) {
            return $this->parentTreeArray[0]->getId();
        }
    }*/
}
