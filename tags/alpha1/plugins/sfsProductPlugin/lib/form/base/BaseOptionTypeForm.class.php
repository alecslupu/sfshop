<?php

/**
 * OptionType form base class.
 *
 * @package    form
 * @subpackage option_type
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOptionTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInput(),
      'pos'        => new sfWidgetFormInput(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'is_deleted' => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'OptionType', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 34, 'required' => false)),
      'pos'        => new sfValidatorInteger(),
      'is_active'  => new sfValidatorBoolean(),
      'is_deleted' => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('option_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OptionType';
  }

  public function getI18nModelName()
  {
    return 'OptionTypeI18n';
  }

  public function getI18nFormClass()
  {
    return 'OptionTypeI18nForm';
  }

}
