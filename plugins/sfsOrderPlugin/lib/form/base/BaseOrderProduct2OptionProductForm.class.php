<?php

/**
 * OrderProduct2OptionProduct form base class.
 *
 * @package    form
 * @subpackage order_product2_option_product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOrderProduct2OptionProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'order_product_id'  => new sfWidgetFormInputHidden(),
      'option_product_id' => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'order_product_id'  => new sfValidatorPropelChoice(array('model' => 'OrderProduct', 'column' => 'id', 'required' => false)),
      'option_product_id' => new sfValidatorPropelChoice(array('model' => 'OptionProduct', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_product2_option_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderProduct2OptionProduct';
  }


}
