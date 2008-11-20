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
 * Base productAdmin actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.productAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
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
    
    protected function saveProduct($product)
    {
        $product->save();
        
        if ($this->getRequest()->hasFile('product[thumbnail]')) {
            $originalThumbnail = ThumbnailPeer::generate($product->getId(), sfConfig::get('app_product_thumbnails_dir_name'), 'Product');
            $fileInfo = sfsThumbnailUtil::uploadFile('product[thumbnail]', $originalThumbnail->getStoragePath());
            
            if ($fileInfo !== null) {
                $thumbnailMime = ThumbnailMimePeer::retrieveByMime($fileInfo['mime']);
                
                $originalThumbnail->setMimeExtension(str_replace('.', '', $fileInfo['extension']));
                $originalThumbnail->setMimeId($thumbnailMime->getId());
                $originalThumbnail->save();
                
                sfsThumbnailUtil::convert();
            }
        }
        
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
    
    public function executeDelete()
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
