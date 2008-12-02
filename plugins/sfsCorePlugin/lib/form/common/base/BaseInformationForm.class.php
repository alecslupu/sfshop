<?php

/**
 * Information form base class.
 *
 * @package    form
 * @subpackage information
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseInformationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'is_deleted' => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Information', 'column' => 'id', 'required' => false)),
      'is_active'  => new sfValidatorBoolean(),
      'is_deleted' => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('information[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Information';
  }

  public function getI18nModelName()
  {
    return 'InformationI18n';
  }

  public function getI18nFormClass()
  {
    return 'InformationI18nForm';
  }

}
