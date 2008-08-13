<?php

/**
 * OptionValue form base class.
 *
 * @package    form
 * @subpackage option_value
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOptionValueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'type_id'    => new sfWidgetFormPropelSelect(array('model' => 'OptionType', 'add_empty' => false)),
      'name'       => new sfWidgetFormInput(),
      'pos'        => new sfWidgetFormInput(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'is_deleted' => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'OptionValue', 'column' => 'id', 'required' => false)),
      'type_id'    => new sfValidatorPropelChoice(array('model' => 'OptionType', 'column' => 'id')),
      'name'       => new sfValidatorString(array('max_length' => 34, 'required' => false)),
      'pos'        => new sfValidatorInteger(),
      'is_active'  => new sfValidatorBoolean(),
      'is_deleted' => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('option_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OptionValue';
  }

  public function getI18nModelName()
  {
    return 'OptionValueI18n';
  }

  public function getI18nFormClass()
  {
    return 'OptionValueI18nForm';
  }

}
