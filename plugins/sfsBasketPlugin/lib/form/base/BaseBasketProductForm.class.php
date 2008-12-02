<?php

/**
 * BasketProduct form base class.
 *
 * @package    form
 * @subpackage basket_product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBasketProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                  => new sfWidgetFormInputHidden(),
      'basket_id'                           => new sfWidgetFormPropelSelect(array('model' => 'Basket', 'add_empty' => false)),
      'product_id'                          => new sfWidgetFormPropelSelect(array('model' => 'Product', 'add_empty' => false)),
      'options_list'                        => new sfWidgetFormInput(),
      'quantity'                            => new sfWidgetFormInput(),
      'created_at'                          => new sfWidgetFormDateTime(),
      'basket_product2_option_product_list' => new sfWidgetFormPropelSelectMany(array('model' => 'OptionProduct')),
    ));

    $this->setValidators(array(
      'id'                                  => new sfValidatorPropelChoice(array('model' => 'BasketProduct', 'column' => 'id', 'required' => false)),
      'basket_id'                           => new sfValidatorPropelChoice(array('model' => 'Basket', 'column' => 'id')),
      'product_id'                          => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id')),
      'options_list'                        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'quantity'                            => new sfValidatorInteger(),
      'created_at'                          => new sfValidatorDateTime(array('required' => false)),
      'basket_product2_option_product_list' => new sfValidatorPropelChoiceMany(array('model' => 'OptionProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('basket_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BasketProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['basket_product2_option_product_list']))
    {
      $values = array();
      foreach ($this->object->getBasketProduct2OptionProducts() as $obj)
      {
        $values[] = $obj->getOptionProductId();
      }

      $this->setDefault('basket_product2_option_product_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveBasketProduct2OptionProductList($con);
  }

  public function saveBasketProduct2OptionProductList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['basket_product2_option_product_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->object->getPrimaryKey());
    BasketProduct2OptionProductPeer::doDelete($c, $con);

    $values = $this->getValue('basket_product2_option_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BasketProduct2OptionProduct();
        $obj->setBasketProductId($this->object->getPrimaryKey());
        $obj->setOptionProductId($value);
        $obj->save();
      }
    }
  }

}
