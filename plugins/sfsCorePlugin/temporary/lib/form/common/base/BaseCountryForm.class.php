<?php

/**
 * Country form base class.
 *
 * @method Country getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'iso'           => new sfWidgetFormInputText(),
      'iso_a3'        => new sfWidgetFormInputText(),
      'iso_n'         => new sfWidgetFormInputText(),
      'title_english' => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'iso'           => new sfValidatorString(array('max_length' => 2)),
      'iso_a3'        => new sfValidatorString(array('max_length' => 3)),
      'iso_n'         => new sfValidatorString(array('max_length' => 3)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getI18nModelName()
  {
    return 'CountryI18n';
  }

  public function getI18nFormClass()
  {
    return 'CountryI18nForm';
  }

}
