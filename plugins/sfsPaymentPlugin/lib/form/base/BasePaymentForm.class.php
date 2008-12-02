<?php

/**
 * Payment form base class.
 *
 * @package    form
 * @subpackage payment
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePaymentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'name'                    => new sfWidgetFormInput(),
      'accept_currencies_codes' => new sfWidgetFormInput(),
      'name_class_form_params'  => new sfWidgetFormInput(),
      'charge_route'            => new sfWidgetFormInput(),
      'icon'                    => new sfWidgetFormInput(),
      'params'                  => new sfWidgetFormTextarea(),
      'is_active'               => new sfWidgetFormInputCheckbox(),
      'is_deleted'              => new sfWidgetFormInputCheckbox(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorPropelChoice(array('model' => 'Payment', 'column' => 'id', 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 64)),
      'accept_currencies_codes' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name_class_form_params'  => new sfValidatorString(array('max_length' => 64)),
      'charge_route'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'icon'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'params'                  => new sfValidatorString(array('required' => false)),
      'is_active'               => new sfValidatorBoolean(),
      'is_deleted'              => new sfValidatorBoolean(),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payment';
  }

  public function getI18nModelName()
  {
    return 'PaymentI18n';
  }

  public function getI18nFormClass()
  {
    return 'PaymentI18nForm';
  }

}
