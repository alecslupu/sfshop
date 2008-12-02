<?php

/**
 * OptionProduct form base class.
 *
 * @package    form
 * @subpackage option_product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOptionProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                  => new sfWidgetFormInputHidden(),
      'option_value_id'                     => new sfWidgetFormPropelSelect(array('model' => 'OptionValue', 'add_empty' => false)),
      'product_id'                          => new sfWidgetFormPropelSelect(array('model' => 'Product', 'add_empty' => false)),
      'price_type'                          => new sfWidgetFormInput(),
      'price'                               => new sfWidgetFormInput(),
      'quantity'                            => new sfWidgetFormInput(),
      'created_at'                          => new sfWidgetFormDateTime(),
      'basket_product2_option_product_list' => new sfWidgetFormPropelSelectMany(array('model' => 'BasketProduct')),
      'order_product2_option_product_list'  => new sfWidgetFormPropelSelectMany(array('model' => 'OrderProduct')),
    ));

    $this->setValidators(array(
      'id'                                  => new sfValidatorPropelChoice(array('model' => 'OptionProduct', 'column' => 'id', 'required' => false)),
      'option_value_id'                     => new sfValidatorPropelChoice(array('model' => 'OptionValue', 'column' => 'id')),
      'product_id'                          => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id')),
      'price_type'                          => new sfValidatorInteger(),
      'price'                               => new sfValidatorNumber(array('required' => false)),
      'quantity'                            => new sfValidatorInteger(),
      'created_at'                          => new sfValidatorDateTime(array('required' => false)),
      'basket_product2_option_product_list' => new sfValidatorPropelChoiceMany(array('model' => 'BasketProduct', 'required' => false)),
      'order_product2_option_product_list'  => new sfValidatorPropelChoiceMany(array('model' => 'OrderProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('option_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OptionProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['basket_product2_option_product_list']))
    {
      $values = array();
      foreach ($this->object->getBasketProduct2OptionProducts() as $obj)
      {
        $values[] = $obj->getBasketProductId();
      }

      $this->setDefault('basket_product2_option_product_list', $values);
    }

    if (isset($this->widgetSchema['order_product2_option_product_list']))
    {
      $values = array();
      foreach ($this->object->getOrderProduct2OptionProducts() as $obj)
      {
        $values[] = $obj->getOrderProductId();
      }

      $this->setDefault('order_product2_option_product_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveBasketProduct2OptionProductList($con);
    $this->saveOrderProduct2OptionProductList($con);
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
    $c->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->object->getPrimaryKey());
    BasketProduct2OptionProductPeer::doDelete($c, $con);

    $values = $this->getValue('basket_product2_option_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BasketProduct2OptionProduct();
        $obj->setOptionProductId($this->object->getPrimaryKey());
        $obj->setBasketProductId($value);
        $obj->save();
      }
    }
  }

  public function saveOrderProduct2OptionProductList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['order_product2_option_product_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->object->getPrimaryKey());
    OrderProduct2OptionProductPeer::doDelete($c, $con);

    $values = $this->getValue('order_product2_option_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new OrderProduct2OptionProduct();
        $obj->setOptionProductId($this->object->getPrimaryKey());
        $obj->setOrderProductId($value);
        $obj->save();
      }
    }
  }

}
