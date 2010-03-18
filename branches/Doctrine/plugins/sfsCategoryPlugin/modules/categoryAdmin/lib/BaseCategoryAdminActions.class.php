<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */
require_once dirname(__FILE__).'/categoryAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/categoryAdminGeneratorHelper.class.php';

/**
 * categoryAdmin actions.
 *
 * @package    plugins.sfsCategoryPlugin
 * @subpackage modules.categoriesAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseCategoryAdminActions extends autocategoryAdminActions
{
    public function executeCatalogList()
    {
		$this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        
        $category = CategoryPeer::retrieveById($this->getRequestParameter('id'));
        
        if ($category != null) {
            $path = $category->getPath();
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
        else {
            $this->redirect('catalogAdmin/list');
        }
    }
    
    public function executeDelete(sfWebRequest $request)
    {
		$this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        
        if ($request->hasParameter('id')) {
            $category = CategoryPeer::retrieveById($request->getParameter('id'));
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

/*            
            $productsIds = Product2CategoryPeer::getProductsIdsByCategoriesIds($ids);
            ProductPeer::deleteByIds($productsIds);
            $path = $category->getCategoryRelatedByParentId()->getPath();
*/            
//            $this->clearFrontendCache();
            
            $this->redirect('catalogAdmin/list?path=' . generate_category_path_for_url($path));
        }
    }
    
    public function executeDeleteThumbnail()
    {
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRequestParameter('id'), 'Category');
        $this->redirect('@categoryAdmin_edit?id=' . $this->getRequestParameter('id'));
    }
}
