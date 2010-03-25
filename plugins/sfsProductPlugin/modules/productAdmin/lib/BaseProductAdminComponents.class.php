<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

require_once dirname(__FILE__).'/productAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/productAdminGeneratorHelper.class.php';

/**
 * Base productAdmin components.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.productAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>, Andreas Nyholm
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
        $this->helper = new productAdminGeneratorHelper();
        $this->component_list = true;
    }
}
