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
 * ProductSearchGroup search group index.
 *
 * @package    lib
 * @subpackage search
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id$
 */
class ProductSearchGroup extends xfIndexGroup
{
   /**
    * Configures initial state of search group index by setting a name.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    protected function initialize()
    {
        $this->setName('ProductSearchGroup');
    }
    
   /**
    * Configures the search index by setting up a service registry and child indices.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    protected function configure()
    {
        $criteria = new Criteria();
        LanguagePeer::addPublicCriteria($criteria);
        $languages = LanguagePeer::getAll($criteria);
        
        foreach ($languages as $language) {
            $productSearch = new ProductSearchIndex();
            $productSearch->setCulture($language->getCulture());
            $this->addIndex($language->getCulture(), $productSearch);
        }
    }
}