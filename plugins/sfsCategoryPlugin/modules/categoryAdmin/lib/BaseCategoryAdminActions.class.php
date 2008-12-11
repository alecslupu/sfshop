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
 * categoryAdmin actions.
 *
 * @package    plugins.sfsCategoryPlugin
 * @subpackage modules.categoriesAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseCategoryAdminActions extends autocategoryAdminActions
{
    public function executeCatalogList()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $category = CategoryPeer::retrieveByPK($this->getRequestParameter('id'));
        
        if ($category != null) {
            $path = $category->getPath();
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
        else {
            $this->redirect('catalogAdmin/list');
        }
    }
    
    public function executeDelete()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        if ($this->hasRequestParameter('id')) {
            $category = CategoryPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($category);
            
            $category->setIsDeleted(1);
            $category->save();
            
            $this->clearFrontendCache();
            
            $ids = array();
            $ids[] = $category->getId();
            
            $child = CategoryPeer::getAllChild($category->getId());
            
            if (count($child) > 0) {
                foreach ($child as $category) {
                    $category->setIsDeleted(1);
                    $category->save();
                    
                    $ids[] = $category->getId();
                }
            }
            
            $productsIds = Product2CategoryPeer::getProductsIdsByCategoriesIds($ids);
            
            ProductPeer::deleteByIds($productsIds);
            
            $path = $category->getCategoryRelatedByParentId()->getPath();
            
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
    }
    
    public function executeDeleteThumbnail()
    {
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRequestParameter('id'), 'Category');
        $this->redirect('categoryAdmin/edit?id=' . $this->getRequestParameter('id'));
    }
    
    protected function saveCategory($category)
    {
        $category->save();
        
        if ($this->getRequest()->hasFile('category[thumbnail]')) {
            $originalThumbnail = ThumbnailPeer::generate($category->getId(), sfConfig::get('app_category_thumbnails_dir_name'), 'Category');
            $fileInfo = sfsThumbnailUtil::uploadFile('category[thumbnail]', $originalThumbnail->getStoragePath());
            
            if ($fileInfo !== null) {
                $thumbnailMime = ThumbnailMimePeer::retrieveByMime($fileInfo['mime']);
                
                $originalThumbnail->setMimeExtension(str_replace('.', '', $fileInfo['extension']));
                $originalThumbnail->setMimeId($thumbnailMime->getId());
                $originalThumbnail->save();
                
                sfsThumbnailUtil::convert();
            }
        }
    }
    
    public function handlePost($type)
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $this->updateCategoryFromRequest();
        
        try {
            $this->saveCategory($this->category);
            //adde by nest
            $this->clearFrontendCache();
        }
        catch (PropelException $e) {
            if ( $type == 'edit' ) {
                $this->getRequest()->setError('edit', 'Could not save the edited Categorys.');
            }
            else {
                $this->getRequest()->setError('create', 'Could not save the created Categorys.');
            }
            
            return $this->forward('catalogAdmin', 'list');
        }
        
        $this->getUser()->setFlash('notice', 'Your modifications have been saved');
        
        if ($this->getRequestParameter('save_and_add')) {
            return $this->redirect('categoryAdmin/create');
        }
        else {
            
            $this->getUser()->setFlash('notice', 'Your modifications have been saved');
            
            if ($this->category->getCategoryRelatedByParentId()) {
                $path = $this->category->getCategoryRelatedByParentId()->getPath();
                $redirectTo = 'catalogAdmin/list?path=' . generate_category_path_for_url($path);
            }
            else {
                $redirectTo = 'catalogAdmin/list';
            }
            
            return $this->redirect($redirectTo);
        }
    }
}
