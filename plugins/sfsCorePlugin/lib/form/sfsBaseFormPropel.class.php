<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfPropelFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class sfsBaseFormPropel extends sfFormPropel
{
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
        $thumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByThumbnailTypeName(ThumbnailPeer::ORIGINAL);
        $path = date('Y/m/d');
        $thumbnail = $this->getObject()->getThumbnail(ThumbnailPeer::ORIGINAL);
        if(!$thumbnail || $thumbnail->getIsBlank())
        {
            $thumbnail = new Thumbnail();
            $thumbnail->setAssetId($this->object->getId());
            $thumbnail->setAssetTypeModel($this->getModelName());
            $thumbnail->setTtatId($thumbnailTypeAssetType->getId());
            $thumbnail->setPath(sfConfig::get('app_'.strtolower($this->getModelName()).'_thumbnails_dir_name', $this->getModelName()) . '/' . $path);
        }
        $thumbnailForm = new ThumbnailForm($thumbnail);
        $thumbnailForm->widgetSchema->setLabels(array('uuid' => false ));
        $this->embedForm('thumbnail', $thumbnailForm);
    }
    
    public function preSaveThumbnail() {
        $thumb_form = $this->getEmbeddedForm('thumbnail');
        if(isset($this->taintedValues['thumbnail']['uuid_delete'])) {
            ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($thumb_form->getObject()->getAssetId(), $this->getModelName());
        }
        if( ! isset($this->taintedFiles['thumbnail']['uuid']['name'])
        or (isset($this->taintedFiles['thumbnail']['uuid']['name']) and ! $this->taintedFiles['thumbnail']['uuid']['name'])) {
            unset($this['thumbnail']);
        }
    }
    
    public function postSaveThumbnail() {
        if(isset($this['thumbnail'])) {
            if($this->isNew()){
                // save again and update id
                $thumb_form->getObject()->setAssetId($this->getObject()->getId());
                parent::save($con);
            }
            ThumbnailPeer::updateThumbnails($this->getObject());
        }
    }
}
