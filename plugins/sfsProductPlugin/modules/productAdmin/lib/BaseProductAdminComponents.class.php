<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
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
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
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
        $this->optionTypes = OptionTypePeer::getAll($criteria);
        
        $this->optionValues = array();
        
        if (count($this->optionTypes) > 0) {
            
            $this->productOptions = $this->product->getOptionProducts();
            
            $criteria = new Criteria();
            OptionValuePeer::addPublicCriteria($criteria);
            
            foreach ($this->optionTypes as $key => $optionType) {
                $optionValues = OptionValuePeer::getByTypeId($optionType->getId(), $criteria);
                print_r($optionValues);
                if (count($optionValues) > 0) {
                    $this->optionValues[$optionType->getId()] = $optionValues;
                }
                else {
                    unset($this->optionTypes[$key]);
                }
            }
        }
        else {
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
