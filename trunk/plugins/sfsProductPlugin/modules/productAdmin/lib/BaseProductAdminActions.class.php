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
        $this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        
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
    
    public function executeDelete(sfWebRequest $request)
    {
        ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($this->getRoute()->getObject()->getId(), 'Product');
        parent::executeDelete($request);
    }
}
