<?php

/**
 * State form base class.
 *
 * @package    form
 * @subpackage state
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseStateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'country_id'    => new sfWidgetFormPropelSelect(array('model' => 'Country', 'add_empty' => false)),
      'iso'           => new sfWidgetFormInput(),
      'title_english' => new sfWidgetFormInput(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'country_id'    => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id')),
      'iso'           => new sfValidatorString(array('max_length' => 2)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('state[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'State';
  }

  public function getI18nModelName()
  {
    return 'StateI18n';
  }

  public function getI18nFormClass()
  {
    return 'StateI18nForm';
  }

}
