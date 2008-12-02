<?php

/**
 * ThumbnailTypeAssetType form base class.
 *
 * @package    form
 * @subpackage thumbnail_type_asset_type
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseThumbnailTypeAssetTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'thumbnail_type_id'   => new sfWidgetFormPropelSelect(array('model' => 'ThumbnailType', 'add_empty' => false)),
      'asset_type_id'       => new sfWidgetFormPropelSelect(array('model' => 'AssetType', 'add_empty' => false)),
      'thumbnail_type_name' => new sfWidgetFormInput(),
      'width'               => new sfWidgetFormInput(),
      'height'              => new sfWidgetFormInput(),
      'is_trim'             => new sfWidgetFormInputCheckbox(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'ThumbnailTypeAssetType', 'column' => 'id', 'required' => false)),
      'thumbnail_type_id'   => new sfValidatorPropelChoice(array('model' => 'ThumbnailType', 'column' => 'id')),
      'asset_type_id'       => new sfValidatorPropelChoice(array('model' => 'AssetType', 'column' => 'id')),
      'thumbnail_type_name' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'width'               => new sfValidatorInteger(),
      'height'              => new sfValidatorInteger(),
      'is_trim'             => new sfValidatorBoolean(),
      'is_active'           => new sfValidatorBoolean(),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('thumbnail_type_asset_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThumbnailTypeAssetType';
  }


}
