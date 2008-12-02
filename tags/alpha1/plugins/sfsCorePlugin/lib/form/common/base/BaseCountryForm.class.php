<?php

/**
 * Country form base class.
 *
 * @package    form
 * @subpackage country
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'iso'           => new sfWidgetFormInput(),
      'iso_a3'        => new sfWidgetFormInput(),
      'iso_n'         => new sfWidgetFormInput(),
      'title_english' => new sfWidgetFormInput(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'iso'           => new sfValidatorString(array('max_length' => 2)),
      'iso_a3'        => new sfValidatorString(array('max_length' => 3)),
      'iso_n'         => new sfValidatorString(array('max_length' => 3)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'     => new sfValidatorBoolean(),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
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
