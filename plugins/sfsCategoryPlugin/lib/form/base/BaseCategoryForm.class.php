<?php

/**
 * Category form base class.
 *
 * @package    form
 * @subpackage category
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'parent_id'              => new sfWidgetFormPropelSelect(array('model' => 'Category', 'add_empty' => true)),
      'name'                   => new sfWidgetFormInput(),
      'path'                   => new sfWidgetFormInput(),
      'pos'                    => new sfWidgetFormInput(),
      'has_child'              => new sfWidgetFormInput(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'is_deleted'             => new sfWidgetFormInputCheckbox(),
      'is_locked'              => new sfWidgetFormInputCheckbox(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'product2_category_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Product')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'parent_id'              => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'path'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pos'                    => new sfValidatorInteger(),
      'has_child'              => new sfValidatorInteger(array('required' => false)),
      'is_active'              => new sfValidatorBoolean(),
      'is_deleted'             => new sfValidatorBoolean(),
      'is_locked'              => new sfValidatorBoolean(),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'product2_category_list' => new sfValidatorPropelChoiceMany(array('model' => 'Product', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getI18nModelName()
  {
    return 'CategoryI18n';
  }

  public function getI18nFormClass()
  {
    return 'CategoryI18nForm';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['product2_category_list']))
    {
      $values = array();
      foreach ($this->object->getProduct2Categorys() as $obj)
      {
        $values[] = $obj->getProductId();
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
    $c->add(Product2CategoryPeer::CATEGORY_ID, $this->object->getPrimaryKey());
    Product2CategoryPeer::doDelete($c, $con);

    $values = $this->getValue('product2_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Product2Category();
        $obj->setCategoryId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

}
