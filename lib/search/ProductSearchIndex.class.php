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
 * ProductSearchIndex search index.
 *
 * @package    lib
 * @subpackage search
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id$
 */
class ProductSearchIndex extends xfIndexSingle
{
    protected $culture = null;
    
   /**
    * Configures initial state of search index by setting a name.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    protected function initialize()
    {
        $this->setName('ProductSearchIndex');
        
        if ($this->getCulture() == null) {
            
            try {
                $this->setCulture(sfContext::getInstance()->getUser()->getCulture());
            }
            catch(sfException $e) {
                
            }
            
        }
    }
    
   /**
    * Sets culture.
    *
    * @param  string $value
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function setCulture($value)
    {
        $this->culture = $value;
    }
    
   /**
    * Gets culture.
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function getCulture()
    {
        return $this->culture;
    }
    
   /**
    * Configures the search index by setting up a search engine and service registry.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    protected function configure()
    {
        $culture = $this->getCulture();
        
        $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir') . '/index/ProductSearchIndex/' . $culture));
        
        $propelIdentifier = new xfPropelIdentifier('Product');
        
        sfPropel::setDefaultCulture($culture);
        $propelIdentifier->setPeerSelectMethod('doSelectWithI18n', xfPropelIdentifier::HYDRATE_COMPLETE);
        
        $service = new xfService($propelIdentifier);
        $service->addBuilder(new xfPropelBuilder(
            array(
                new xfField('id', xfField::STORED | xfField::INDEXED),
                new xfField('title', xfField::TEXT),
                new xfField('description', xfField::TEXT)
            )
        ));
        
        $service->addRetort(new xfRetortField);
        
        $this->getServiceRegistry()->register($service);
    }
}