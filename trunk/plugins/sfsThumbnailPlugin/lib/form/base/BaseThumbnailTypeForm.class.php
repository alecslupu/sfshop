<?php

/**
 * ThumbnailType form base class.
 *
 * @package    form
 * @subpackage thumbnail_type
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseThumbnailTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'is_active' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ThumbnailType', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active' => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('thumbnail_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThumbnailType';
  }


}
