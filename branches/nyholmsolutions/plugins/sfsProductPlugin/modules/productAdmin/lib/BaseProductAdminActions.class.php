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
            $product = ProductPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($product);
            $category = CategoryPeer::retrieveByPK($product->getCategoryId());
            $path = $category->getPath();
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
        else {
            $this->redirect('catalogAdmin/list');
        }
    }
    
    public function executeDeleteThumbnail()
    {
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRequestParameter('id'), 'Product');
        $this->redirect('productAdmin/edit?id=' . $this->getRequestParameter('id'));
    }
    

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
     $taintedFiles = $request->getFiles($form->getName());
     if(!$taintedFiles['name']['thumbnail']['uuid']) {
        unset($taintedFiles['thumbnail']);
        $form->unsetThumbnail();
     }
      
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');

      $product = $form->save();

      $this->saveProductSettings($product,$form);
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $product)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');

        $this->redirect('@product_new');
      }
      else
      {
        $this->redirect('@product_edit?id='.$product->getId());
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
    
    public function handlePost($type)
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $this->updateProductFromRequest();
        
        try
        {
            $this->saveProduct($this->product);
            $this->clearFrontendCache();
        }
        catch (PropelException $e)
        {
            if ( $type == 'edit' ) {
                $this->getRequest()->setError('edit', 'Could not save the edited Products.');
            }
            else {
                $this->getRequest()->setError('create', 'Could not save the created Products.');
            }
            
            return $this->forward('catalogAdmin', 'list');
        }
        
        $this->getUser()->setFlash('notice', 'Your modifications have been saved');
        
        if ($this->getRequestParameter('save_and_add'))
        {
            return $this->redirect('productAdmin/create');
        }
        else
        {
            list($product2Category) = $this->product->getProduct2CategorysJoinCategory();
            $path = $product2Category->getCategory()->getPath();
            return $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
    }
    

    public function executeDelete(sfWebRequest $request)
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $product = ProductPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($product);
        
        $this->deleteProduct($product);
        
        list($product2Category) = $product->getProduct2CategorysJoinCategory();
        
        $path = $product2Category->getCategory()->getPath();
        $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
    }
}
