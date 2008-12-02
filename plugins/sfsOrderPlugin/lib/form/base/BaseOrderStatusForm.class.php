<?php

/**
 * OrderStatus form base class.
 *
 * @package    form
 * @subpackage order_status
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOrderStatusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInput(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'OrderStatus', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'  => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderStatus';
  }

  public function getI18nModelName()
  {
    return 'OrderStatusI18n';
  }

  public function getI18nFormClass()
  {
    return 'OrderStatusI18nForm';
  }

}
