<?php

/**
 * OrderProduct form base class.
 *
 * @package    form
 * @subpackage order_product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOrderProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                 => new sfWidgetFormInputHidden(),
      'order_item_id'                      => new sfWidgetFormPropelSelect(array('model' => 'OrderItem', 'add_empty' => false)),
      'product_id'                         => new sfWidgetFormPropelSelect(array('model' => 'Product', 'add_empty' => false)),
      'price'                              => new sfWidgetFormInput(),
      'quantity'                           => new sfWidgetFormInput(),
      'created_at'                         => new sfWidgetFormDateTime(),
      'order_product2_option_product_list' => new sfWidgetFormPropelSelectMany(array('model' => 'OptionProduct')),
    ));

    $this->setValidators(array(
      'id'                                 => new sfValidatorPropelChoice(array('model' => 'OrderProduct', 'column' => 'id', 'required' => false)),
      'order_item_id'                      => new sfValidatorPropelChoice(array('model' => 'OrderItem', 'column' => 'id')),
      'product_id'                         => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id')),
      'price'                              => new sfValidatorNumber(array('required' => false)),
      'quantity'                           => new sfValidatorInteger(),
      'created_at'                         => new sfValidatorDateTime(array('required' => false)),
      'order_product2_option_product_list' => new sfValidatorPropelChoiceMany(array('model' => 'OptionProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['order_product2_option_product_list']))
    {
      $values = array();
      foreach ($this->object->getOrderProduct2OptionProducts() as $obj)
      {
        $values[] = $obj->getOptionProductId();
      }

      $this->setDefault('order_product2_option_product_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveOrderProduct2OptionProductList($con);
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
    $c->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->object->getPrimaryKey());
    OrderProduct2OptionProductPeer::doDelete($c, $con);

    $values = $this->getValue('order_product2_option_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new OrderProduct2OptionProduct();
        $obj->setOrderProductId($this->object->getPrimaryKey());
        $obj->setOptionProductId($value);
        $obj->save();
      }
    }
  }

}
