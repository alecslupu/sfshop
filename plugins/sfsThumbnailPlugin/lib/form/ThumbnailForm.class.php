<?php

/**
 * Thumbnail form.
 *
 * @package    form
 * @subpackage thumbnails
 * @author     Andreas Nyholm
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ThumbnailForm extends BaseThumbnailForm
{
  public function configure()
  {
      unset(
        $this['id'], 
        $this['parent_id'], 
        $this['mime_id'],
        $this['mime_extension'], 
        $this['is_blank'], 
        $this['is_converted'], 
        $this['created_at'], 
        $this['updated_at']
      );
      
      $this->setWidget('asset_id', new sfWidgetFormInputHidden);
      $this->setWidget('asset_type_model', new sfWidgetFormInputHidden);
      $this->setWidget('ttat_id', new sfWidgetFormInputHidden);
      $this->setWidget('path', new sfWidgetFormInputHidden);

     $this->object->setIsConverted(true);
        
//    $this->widgetSchema['uuid'] = new sfWidgetFormInputFile();
     $this->widgetSchema['uuid'] = new sfWidgetFormInputFileEditable(array(
        'file_src' => $this->object->getUploadUrl(),
        'is_image' => true,
        'with_delete' => true
     ));
        
     $this->validatorSchema['uuid_delete'] = new sfValidatorBoolean();
     
     $this->validatorSchema['uuid'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => $this->object->getUploadPath(),
      'mime_types' => 'web_images',
    ));
  }
  
}
