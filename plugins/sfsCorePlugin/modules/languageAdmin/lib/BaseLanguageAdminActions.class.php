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
 * @version    SVN: $Id$
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
    
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $isNew = false;
        
        if ($form->getObject()->isNew()) {
            $isNew = true;
        }
        else {
            $oldCulture = $form->getObject()->getCulture();
        }
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
         
        if ($form->isValid()) {
            $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');
            
            $language = $form->save();
            
            $icon = $this->form->getValue('icon');
            
            if ($icon) {
                $fileExtension = $icon->getExtension($icon->getOriginalExtension());
                
                $path = str_replace('icon.png', '', $language->getIconPath());
                
                if (!file_exists($path)) {
                    mkdir($path);
                }
                
                if ($icon->save($path . 'icon_temp' . $fileExtension)) {
                    $size = getimagesize($path . 'icon_temp' . $fileExtension);
                    
                    if (file_exists($language->getIconPath())) {
                        unlink($language->getIconPath());
                    }
                    
                    $thumb = new sfThumbnail($size[0], $size[1], true, true, 75, 'sfGDAdapter');
                    $thumb->loadFile($path . 'icon_temp' . $fileExtension);
                    $thumb->save($language->getIconPath(), 'image/png');
                    unlink($path . 'icon_temp' . $fileExtension);
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
            
            
            
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $language)));
            
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');
                $this->redirect('@languageAdmin_new');
            }
            else {
                $this->redirect('@languageAdmin_edit?id='.$language->getId());
            }
        }
        else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
        }
    }
}
