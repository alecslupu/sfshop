<?php

/**
 * AssetType form base class.
 *
 * @method AssetType getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAssetTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'model'         => new sfWidgetFormInputText(),
      'has_thumbnail' => new sfWidgetFormInputText(),
      'has_i18n'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'AssetType', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'model'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'has_thumbnail' => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'has_i18n'      => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
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
