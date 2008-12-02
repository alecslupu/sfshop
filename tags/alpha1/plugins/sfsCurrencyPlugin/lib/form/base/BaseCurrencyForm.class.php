<?php

/**
 * Currency form base class.
 *
 * @package    form
 * @subpackage currency
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCurrencyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'code'            => new sfWidgetFormInput(),
      'decimal_point'   => new sfWidgetFormInput(),
      'thousands_point' => new sfWidgetFormInput(),
      'decimal_places'  => new sfWidgetFormInput(),
      'value'           => new sfWidgetFormInput(),
      'is_default'      => new sfWidgetFormInputCheckbox(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id', 'required' => false)),
      'code'            => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'decimal_point'   => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'thousands_point' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'decimal_places'  => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'value'           => new sfValidatorNumber(array('required' => false)),
      'is_default'      => new sfValidatorBoolean(),
      'is_active'       => new sfValidatorBoolean(),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('currency[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Currency';
  }

  public function getI18nModelName()
  {
    return 'CurrencyI18n';
  }

  public function getI18nFormClass()
  {
    return 'CurrencyI18nForm';
  }

}
