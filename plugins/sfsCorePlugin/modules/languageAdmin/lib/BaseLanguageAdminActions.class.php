<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Base languageAdmin actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.languageAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseLanguageAdminActions extends autolanguageAdminActions
{
    
    protected function saveLanguage($language)
    {
        $isNew = false;
        
        if ($language->isNew()) {
            $isNew = true;
        }
        else {
            $oldCulture = LanguagePeer::retrieveById($language->getId())->getCulture();
        }
        
        $language->save();
        
        if ($this->getRequest()->hasFiles()) {
            $fileExtension = $this->getRequest()->getFileExtension('language[icon]');
            
            $path = str_replace('icon.png', '', $language->getIconPath());
            
            if (!file_exists($path)) {
                mkdir($path);
            }
            
            if ($this->getRequest()->moveFile('language[icon]', $path . 'icon' . $fileExtension)) {
                $size = getimagesize($path . 'icon' . $fileExtension);
                
                if (file_exists($language->getIconPath())) {
                    unlink($language->getIconPath());
                }
                
                $thumb = new sfThumbnail($size[0], $size[1], true, true, 75, 'sfGDAdapter');
                $thumb->loadFile($path . 'icon' . $fileExtension);
                $thumb->save($language->getIconPath(), 'image/png');
                unlink($path . 'icon' . $fileExtension);
            }
        }
        
        if (!$isNew) {
            $criteria = new Criteria();
            $criteria->add(AssetTypePeer::HAS_I18N, true);
            $assetTypes = AssetTypePeer::getAll($criteria);
            
            foreach ($assetTypes as $assetType) {
                if (is_callable($assetType->getModel() . 'Peer::updateCulture') && $oldCulture != $language->getCulture()) {
                    call_user_func($assetType->getModel() . 'Peer::updateCulture', $oldCulture, $language->getCulture());
                }
            }
        }
        
    }
}