<?php

/**
 * Product2Category form base class.
 *
 * @package    form
 * @subpackage product2_category
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseProduct2CategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'  => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
      'pos'         => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'product_id'  => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'pos'         => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product2_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product2Category';
  }


}
