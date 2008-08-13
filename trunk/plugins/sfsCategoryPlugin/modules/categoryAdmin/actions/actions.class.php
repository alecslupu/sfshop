<?php

/**
 * categoryAdmin actions.
 *
 * @package    sfShop
 * @subpackage categoryAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class categoryAdminActions extends autocategoryAdminActions
{
    public function executeCatalogList()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        $category = CategoryPeer::retrieveByPK($this->getRequestParameter('id'));
        $path = $category->getPath();
        $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
    }
    
    public function executeDelete()
    {
        sfLoader::loadHelpers('sfsCategory');
        
        if ($this->hasRequestParameter('id')) {
            $category = CategoryPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($category);
            
            $category->setIsDeleted(1);
            $category->save();
            
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
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRequestParameter('id'), 'Product');
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
}
