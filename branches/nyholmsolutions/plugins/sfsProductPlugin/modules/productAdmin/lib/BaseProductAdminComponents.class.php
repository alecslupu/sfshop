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
 * Base productAdmin components.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.productAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseProductAdminComponents extends sfComponents 
{
    
    public function executeList()
    {
        $this->currentCategoryId = 0;
        $this->pager = null;
        
        $this->path  = null;
        $this->route = 'catalogAdmin/list?page=';
        
        
        if ($this->hasRequestParameter('path')) {
            $this->path = $this->getRequestParameter('path');
            $this->route = 'catalogAdmin/list?path=' . $this->path . '&page=';
            
            $c = explode(sfConfig::get('app_category_url_separator', '_'), $this->path);
            $this->currentCategoryId = $c[count($c) - 1];
            
            $c = new Criteria();
            ProductPeer::addPublicCriteria($c);
            $c->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);
            $c->addAnd(Product2CategoryPeer::CATEGORY_ID, $this->currentCategoryId);
            
            $this->pager = new sfPropelPager('Product', 20);
            $this->pager->setPeerMethod('doSelectWithTranslation');
            $this->pager->setCriteria($c);
            $this->pager->setPage($this->getRequestParameter('page', 1));
            $this->pager->init();
        }
    }
    
    public function executeEditOptionsListForm()
    {
        $criteria = new Criteria();
        OptionTypePeer::addPublicCriteria($criteria);
        
        //Local array needed with php5.2.0
        $this->optionTypes = $oTypes = OptionTypePeer::getAll($criteria);
     
        $this->optionValues = $oValues = array();
        
        if (count($oTypes) > 0) {
            
            $this->productOptions = $this->product->getOptionProducts();
            
            $criteria = new Criteria();
            OptionValuePeer::addPublicCriteria($criteria);
            
            foreach ($oTypes as $key => $optionType) {
                $optionValues = OptionValuePeer::getByTypeId($optionType->getId(), $criteria);
                
                if (count($optionValues) > 0) {
                    $oValues[$optionType->getId()] = $optionValues;
                }
                else {
                    unset($oTypes[$key]);
                }
            }
            $this->optionValues = $oValues;
            $this->optionTypes = $oTypes;
        }
        else {
            return sfView::NONE;
        }
        
        if (count($this->optionTypes) < 1) {
            return sfView::NONE;
        }
    }
    
    public function executeAddOptionValueForm()
    {
        $criteria = new Criteria();
        LanguagePeer::addPublicCriteria($criteria);
        $this->languages = LanguagePeer::getAll($criteria);
    }
}
