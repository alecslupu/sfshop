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
 * Base productAdmin actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.productAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>, Andreas Nyholm
 * @version    SVN: $Id$
 */
class BaseProductAdminActions extends autoproductAdminActions
{
    public function executeCatalogList()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        if ($this->getRequestParameter('id') != '') {
            $product = ProductPeer::retrieveById($this->getRequestParameter('id'));
            $this->forward404Unless($product);
            $category = CategoryPeer::retrieveById($product->getCategoryId());
            $path = $category->getPath();
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
        else {
            $this->redirect('catalogAdmin/list');
        }
    }
    


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
      
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
        
      $product = $form->save();

      $this->saveProductSettings($product,$form);
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $product)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@productAdmin_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('@productAdmin_edit?id='.$product->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
    
    protected function saveProductSettings($product,$form)
    {
        
        $hasOptions = false;
        
        if ($this->getRequest()->hasParameter('product[options]')) {
            
            OptionProductPeer::deleteByProductId($product->getId());
            
            $options = $this->getRequest()->getParameter('product[options]');
            foreach ($options as $key => $params) {
                if (isset($params['is_used'])) {
                    $optionProduct = new OptionProduct();
                    
                    $price = $params['price'];
                    
                    if ($params['prefix'] == 'minus') {
                        $price = $price * (-1);
                    }
                    
                    $optionProduct->setPrice($price);
                    $optionProduct->setOptionValueId($key);
                    $optionProduct->setProductId($product->getId());
                    $optionProduct->setPriceType(OptionProductPeer::PRICE_TYPE_ADD);
                    $optionProduct->save();
                    
                    $hasOptions = true;
                }
            }
        }
        
        $product->setHasOptions($hasOptions);
        $product->save();
    }
 
    public function executeDelete(sfWebRequest $request)
    {
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRoute()->getObject()->getId(), 'Product');
        parent::executeDelete($request);
    }
}
