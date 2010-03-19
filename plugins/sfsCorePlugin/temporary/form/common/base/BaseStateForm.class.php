<?php

/**
 * State form base class.
 *
 * @method State getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseStateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'country_id'    => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => false)),
      'iso'           => new sfWidgetFormInputText(),
      'title_english' => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'country_id'    => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id')),
      'iso'           => new sfValidatorString(array('max_length' => 2)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(),
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
