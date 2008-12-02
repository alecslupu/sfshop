<?php

/**
 * CurrencyI18n form base class.
 *
 * @package    form
 * @subpackage currency_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCurrencyI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'culture'      => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInput(),
      'symbol_left'  => new sfWidgetFormInput(),
      'symbol_right' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id', 'required' => false)),
      'culture'      => new sfValidatorPropelChoice(array('model' => 'CurrencyI18n', 'column' => 'culture', 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'symbol_left'  => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'symbol_right' => new sfValidatorString(array('max_length' => 16, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('currency_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrencyI18n';
  }


}
