<?php

/**
 * Thumbnail form base class.
 *
 * @package    form
 * @subpackage thumbnail
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseThumbnailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'parent_id'        => new sfWidgetFormPropelSelect(array('model' => 'Thumbnail', 'add_empty' => true)),
      'ttat_id'          => new sfWidgetFormPropelSelect(array('model' => 'ThumbnailTypeAssetType', 'add_empty' => true)),
      'mime_id'          => new sfWidgetFormPropelSelect(array('model' => 'ThumbnailMime', 'add_empty' => true)),
      'asset_id'         => new sfWidgetFormInput(),
      'uuid'             => new sfWidgetFormInput(),
      'asset_type_model' => new sfWidgetFormInput(),
      'mime_extension'   => new sfWidgetFormInput(),
      'path'             => new sfWidgetFormInput(),
      'is_blank'         => new sfWidgetFormInputCheckbox(),
      'is_converted'     => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Thumbnail', 'column' => 'id', 'required' => false)),
      'parent_id'        => new sfValidatorPropelChoice(array('model' => 'Thumbnail', 'column' => 'id', 'required' => false)),
      'ttat_id'          => new sfValidatorPropelChoice(array('model' => 'ThumbnailTypeAssetType', 'column' => 'id', 'required' => false)),
      'mime_id'          => new sfValidatorPropelChoice(array('model' => 'ThumbnailMime', 'column' => 'id', 'required' => false)),
      'asset_id'         => new sfValidatorInteger(array('required' => false)),
      'uuid'             => new sfValidatorString(array('max_length' => 32)),
      'asset_type_model' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'mime_extension'   => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'path'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_blank'         => new sfValidatorBoolean(),
      'is_converted'     => new sfValidatorBoolean(),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('thumbnail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Thumbnail';
  }


}
