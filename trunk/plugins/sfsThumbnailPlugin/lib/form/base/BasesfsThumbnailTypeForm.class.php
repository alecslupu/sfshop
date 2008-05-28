<?php

/**
 * sfsThumbnailType form base class.
 *
 * @package    form
 * @subpackage sfs_thumbnail_type
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasesfsThumbnailTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'asset_type_id' => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'is_active'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'sfsThumbnailType', 'column' => 'id', 'required' => false)),
      'asset_type_id' => new sfValidatorPropelChoice(array('model' => 'sfsAssetsTypes', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'is_active'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sfs_thumbnail_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfsThumbnailType';
  }


}
