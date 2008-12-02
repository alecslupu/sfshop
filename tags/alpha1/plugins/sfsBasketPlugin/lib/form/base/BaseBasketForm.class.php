<?php

/**
 * Basket form base class.
 *
 * @package    form
 * @subpackage basket
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBasketForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'member_id'   => new sfWidgetFormPropelSelect(array('model' => 'Member', 'add_empty' => true)),
      'currency_id' => new sfWidgetFormPropelSelect(array('model' => 'Currency', 'add_empty' => true)),
      'access_num'  => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Basket', 'column' => 'id', 'required' => false)),
      'member_id'   => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id', 'required' => false)),
      'currency_id' => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id', 'required' => false)),
      'access_num'  => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('basket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Basket';
  }


}
