<?php

/**
 * Delivery form base class.
 *
 * @package    form
 * @subpackage delivery
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseDeliveryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'accept_currencies_codes' => new sfWidgetFormInput(),
      'name_class_service'      => new sfWidgetFormInput(),
      'name_class_form_params'  => new sfWidgetFormInput(),
      'icon'                    => new sfWidgetFormInput(),
      'params'                  => new sfWidgetFormTextarea(),
      'is_active'               => new sfWidgetFormInputCheckbox(),
      'is_deleted'              => new sfWidgetFormInputCheckbox(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorPropelChoice(array('model' => 'Delivery', 'column' => 'id', 'required' => false)),
      'accept_currencies_codes' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name_class_service'      => new sfValidatorString(array('max_length' => 64)),
      'name_class_form_params'  => new sfValidatorString(array('max_length' => 64)),
      'icon'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'params'                  => new sfValidatorString(array('required' => false)),
      'is_active'               => new sfValidatorBoolean(),
      'is_deleted'              => new sfValidatorBoolean(),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('delivery[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Delivery';
  }

  public function getI18nModelName()
  {
    return 'DeliveryI18n';
  }

  public function getI18nFormClass()
  {
    return 'DeliveryI18nForm';
  }

}
