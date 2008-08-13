<?php

/**
 * BasketProduct2OptionProduct form base class.
 *
 * @package    form
 * @subpackage basket_product2_option_product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBasketProduct2OptionProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'basket_product_id' => new sfWidgetFormInputHidden(),
      'option_product_id' => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'basket_product_id' => new sfValidatorPropelChoice(array('model' => 'BasketProduct', 'column' => 'id', 'required' => false)),
      'option_product_id' => new sfValidatorPropelChoice(array('model' => 'OptionProduct', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('basket_product2_option_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BasketProduct2OptionProduct';
  }


}
