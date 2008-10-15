<?php

/**
 * ProductSearchIndex search index.
 *
 * @package     sfShop
 * @subpackage  search
 * @author      Your name here
 * @version     SVN: $Id$
 */
class ProductSearchIndex extends xfIndexSingle
{
  /**
   * Configures initial state of search index by setting a name.
   *
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setName('ProductSearchIndex');
  }

  /**
   * Configures the search index by setting up a search engine and service
   * registry.
   *
   * @see xfIndex
   */
    protected function configure()
    {
        $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir') . '/index/ProductSearchIndex'));
        
        $service = new xfService(new xfPropelIdentifier('Product'));
        $service->addBuilder(new xfPropelBuilder(
            array(
                new xfField('id', xfField::INDEXED),
                new xfField('title', xfField::TEXT),
                new xfField('description', xfField::TEXT)
            )
        ));
        $service->addRetort(new xfRetortField);
        $service->addRetort(new xfRetortRoute('@product_details?isbn=$id$'));
        
        $this->getServiceRegistry()->register($service);
  }
}