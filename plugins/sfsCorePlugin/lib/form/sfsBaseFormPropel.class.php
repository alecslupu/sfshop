<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfPropelFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class sfsBaseFormPropel extends sfFormPropel
{
    protected 
        $ttat;
    
   /**
    * Define custom error for form.
    *
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @param string $fieldName
    * @param string $message
    * @return void
    */
    public function defineError($fieldName, $message)
    {
        $checkName = 'check_define_' . md5($fieldName);
        $this->getErrorSchema()->getValidator()->addOption($checkName);
        $this->getErrorSchema()->getValidator()->addMessage($checkName, $message);
        
        $this->getErrorSchema()->addError(
            new sfValidatorError(
                $this->getErrorSchema()->getValidator(),
                $checkName,
                array(
                    'value' => sfContext::getInstance()->getRequest()->getParameter($fieldName)
                )
            )
        );
        
    }
    
   /**
    * Define list formatter for frontend.
    *
    * @author Dmitry Nesteruk
    * @param  void
    * @return void
    */
    public function defineSfsListFormatter()
    {
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
    }
    
   /**
    * Define list formatter for backend.
    *
    * @author Dmitry Nesteruk
    * @param  void
    * @return void
    */
    public function defineSfsAdminListFormatter()
    {
        $this->getWidgetSchema()->addFormFormatter('sfs_admin_list', new sfsWidgetFormSchemaFormatterAdminList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_admin_list');
    }
    
    public static function radioFormatter($widget, $inputs)
    {
        $rows = array();
        
        foreach ($inputs as $input) {
            $rows[] = array('input'=> $input['input'], 'label'=> $input['label']);
        }
        
        return $rows;
    }
    
   /**
    * Embeds I18n forms for all cultures.
    *
    * @author Dmitry Nesteruk
    * @param  void
    * @return void
    */
    public function embedI18nForAllCultures()
    {
        $languages = LanguagePeer::getAllPublic();
        $cultures = array();
        
        foreach ($languages as $language) {
            $cultures[] = $language->getCulture();
        }
        
        $this->embedI18n($cultures);
        
        foreach ($languages as $language) {
            $this->getWidgetSchema()->setLabel($language->getCulture(), $language->getTitleEnglish());
        }
    }
    
    public function embedThumbnailForm()
    {
        $path = date('Y/m/d');
        $wrapperForm = new sfForm;
        foreach($this->getObject()->getThumbnails(ThumbnailPeer::ORIGINAL) as $thumbnail)
        {
            if(!$thumbnail || $thumbnail->getIsBlank())
            {
                $thumbnail = new Thumbnail;
                $thumbnail->setAssetId($this->object->getId());
                $thumbnail->setAssetTypeModel($this->getModelName());
                $thumbnail->setTtatId($this->getTtatId());
                $thumbnail->setPath(sfConfig::get('app_'.strtolower($this->getModelName()).'_thumbnails_dir_name', $this->getModelName()) . '/' . $path);
            }
            $thumbnailForm = new ThumbnailForm($thumbnail);
            $thumbnailForm->widgetSchema->setLabel('uuid', false);
            
            $wrapperForm->embedForm($thumbnail->getId(), $thumbnailForm);
        }
        $wrapperForm->setWidget('add_new_thumbnail', new sfWidgetFormInputCheckbox);
        $wrapperForm->setValidator('add_new_thumbnail', new sfValidatorBoolean(array('required' => false)));
        
        $new_thumb_form = new ThumbnailForm;
        $new_thumb_form->setDefault('asset_id', $this->getObject()->getId());
        $new_thumb_form->setDefault('ttat_id', $this->getTtatId());
        $new_thumb_form->setDefault('asset_type_model', $this->getModelName());
        $new_thumb_form->setDefault('path', sfConfig::get('app_'.strtolower($this->getModelName()).'_thumbnails_dir_name', $this->getModelName()) . '/' . $path);
        $wrapperForm->embedForm('new_thumbnail', $new_thumb_form);
        
        $this->embedForm('thumbnail', $wrapperForm);
    }
    
    public function getTtat($thumbnailType=ThumbnailPeer::ORIGINAL)
    {
        if(!$this->ttat)
        {
            $this->ttat = ThumbnailTypeAssetTypePeer::retrieveByTypeAndAssetName($thumbnailType, $this->getModelName());
        }
        return $this->ttat;
    }
    
    public function getTtatId($thumbnailType=ThumbnailPeer::ORIGINAL)
    {
        $ttat = $this->getTtat();
        return $ttat ? $ttat->getId() : null;
    }
    
    public function preSaveThumbnail() 
    {
        if( ! isset($this->taintedValues['thumbnail']['add_new_thumbnail']) 
        or (isset($this->taintedValues['thumbnail']['add_new_thumbnail']) and ! $this->taintedValues['thumbnail']['add_new_thumbnail'])) 
        {
            //if the "new" checkbox is unchecked, we don't want to add a new one 
            // so we unset it to avoid the sfForm::save method to insert it anyway. 
            $this->getEmbeddedForm('thumbnail')->offsetUnset('new_thumbnail');
        }
        foreach($this->getEmbeddedForm('thumbnail')->getEmbeddedForms() as $id => $thumb_form) 
        {
            if( isset($this->taintedValues['thumbnail'][$id]['uuid_delete']) and $this->taintedValues['thumbnail'][$id]['uuid_delete']) 
            {
                // if the "delete" checkbox is checked, we want to delete it,
                // so we unset it to avoid the sfForm::save method to reinsert it after having deleted it. 
                $this->getEmbeddedForm('thumbnail')->offsetUnset($id);
                ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($thumb_form->getObject()->getAssetId(), $this->getModelName());
            }
            if( ! isset($this->taintedFiles['thumbnail'][$id]['uuid']['name'])
            or (isset($this->taintedFiles['thumbnail'][$id]['uuid']['name']) and ! $this->taintedFiles['thumbnail'][$id]['uuid']['name'])) 
            {
                $this->getEmbeddedForm('thumbnail')->offsetUnset($id);
            }
        }
    }
    
    public function postSaveThumbnail()
    {
        foreach($this->getEmbeddedForm('thumbnail')->getEmbeddedForms() as $id => $thumb_form)
        {
            if(isset($this['thumbnail'][$id])) {
                if($this->isNew())
                {
                    $thumb_form->getObject()->setAssetId($this->getObject()->getId());
                    parent::save($con);
                }
            }
        }
        ThumbnailPeer::updateThumbnails($this->getObject());
    }
}
