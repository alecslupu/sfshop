<?php

/**
 * OrderStatusI18n form base class.
 *
 * @package    form
 * @subpackage order_status_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOrderStatusI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
      'title'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'OrderStatus', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorPropelChoice(array('model' => 'OrderStatusI18n', 'column' => 'culture', 'required' => false)),
      'title'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_status_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderStatusI18n';
  }


}
