<?php

/**
 * sfsThumbnails2Assets form base class.
 *
 * @package    form
 * @subpackage sfs_thumbnails2_assets
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasesfsThumbnails2AssetsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'asset_id'       => new sfWidgetFormInput(),
      'asset_model'    => new sfWidgetFormInput(),
      'thumbnail_type' => new sfWidgetFormInput(),
      'width'          => new sfWidgetFormInput(),
      'height'         => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'is_original'    => new sfWidgetFormInput(),
      'is_converted'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'sfsThumbnails2Assets', 'column' => 'id', 'required' => false)),
      'asset_id'       => new sfValidatorInteger(array('required' => false)),
      'asset_model'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'thumbnail_type' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'width'          => new sfValidatorInteger(array('required' => false)),
      'height'         => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'is_original'    => new sfValidatorInteger(array('required' => false)),
      'is_converted'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sfs_thumbnails2_assets[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfsThumbnails2Assets';
  }


}
