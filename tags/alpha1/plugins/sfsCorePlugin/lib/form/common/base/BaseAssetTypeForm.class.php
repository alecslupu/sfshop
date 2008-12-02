<?php

/**
 * AssetType form base class.
 *
 * @package    form
 * @subpackage asset_type
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAssetTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'model'         => new sfWidgetFormInput(),
      'has_thumbnail' => new sfWidgetFormInput(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'AssetType', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'model'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'has_thumbnail' => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('asset_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AssetType';
  }


}
