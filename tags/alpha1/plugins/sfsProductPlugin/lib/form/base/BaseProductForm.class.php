<?php

/**
 * Product form base class.
 *
 * @package    form
 * @subpackage product
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'brand_id'               => new sfWidgetFormPropelSelect(array('model' => 'Brand', 'add_empty' => true)),
      'price'                  => new sfWidgetFormInput(),
      'quantity'               => new sfWidgetFormInput(),
      'weight'                 => new sfWidgetFormInput(),
      'cube'                   => new sfWidgetFormInput(),
      'has_options'            => new sfWidgetFormInput(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'is_deleted'             => new sfWidgetFormInputCheckbox(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'product2_category_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Category')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
      'brand_id'               => new sfValidatorPropelChoice(array('model' => 'Brand', 'column' => 'id', 'required' => false)),
      'price'                  => new sfValidatorNumber(array('required' => false)),
      'quantity'               => new sfValidatorInteger(),
      'weight'                 => new sfValidatorNumber(array('required' => false)),
      'cube'                   => new sfValidatorNumber(array('required' => false)),
      'has_options'            => new sfValidatorInteger(array('required' => false)),
      'is_active'              => new sfValidatorBoolean(),
      'is_deleted'             => new sfValidatorBoolean(),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'product2_category_list' => new sfValidatorPropelChoiceMany(array('model' => 'Category', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getI18nModelName()
  {
    return 'ProductI18n';
  }

  public function getI18nFormClass()
  {
    return 'ProductI18nForm';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['product2_category_list']))
    {
      $values = array();
      foreach ($this->object->getProduct2Categorys() as $obj)
      {
        $values[] = $obj->getCategoryId();
      }

      $this->setDefault('product2_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveProduct2CategoryList($con);
  }

  public function saveProduct2CategoryList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['product2_category_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(Product2CategoryPeer::PRODUCT_ID, $this->object->getPrimaryKey());
    Product2CategoryPeer::doDelete($c, $con);

    $values = $this->getValue('product2_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Product2Category();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setCategoryId($value);
        $obj->save();
      }
    }
  }

}
