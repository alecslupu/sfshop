<?php

/**
 * OrderItem form base class.
 *
 * @package    form
 * @subpackage order_item
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseOrderItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'uuid'                  => new sfWidgetFormInput(),
      'delivery_id'           => new sfWidgetFormPropelSelect(array('model' => 'Delivery', 'add_empty' => true)),
      'delivery_method_title' => new sfWidgetFormInput(),
      'delivery_description'  => new sfWidgetFormTextarea(),
      'delivery_price'        => new sfWidgetFormInput(),
      'member_id'             => new sfWidgetFormPropelSelect(array('model' => 'Member', 'add_empty' => false)),
      'member_first_name'     => new sfWidgetFormInput(),
      'member_last_name'      => new sfWidgetFormInput(),
      'member_country_id'     => new sfWidgetFormPropelSelect(array('model' => 'Country', 'add_empty' => true)),
      'member_state_id'       => new sfWidgetFormPropelSelect(array('model' => 'State', 'add_empty' => true)),
      'member_state_title'    => new sfWidgetFormInput(),
      'member_city'           => new sfWidgetFormInput(),
      'member_street'         => new sfWidgetFormInput(),
      'member_postcode'       => new sfWidgetFormInput(),
      'billing_first_name'    => new sfWidgetFormInput(),
      'billing_last_name'     => new sfWidgetFormInput(),
      'billing_country_id'    => new sfWidgetFormPropelSelect(array('model' => 'Country', 'add_empty' => true)),
      'billing_state_id'      => new sfWidgetFormPropelSelect(array('model' => 'State', 'add_empty' => true)),
      'billing_state_title'   => new sfWidgetFormInput(),
      'billing_city'          => new sfWidgetFormInput(),
      'billing_street'        => new sfWidgetFormInput(),
      'billing_postcode'      => new sfWidgetFormInput(),
      'delivery_first_name'   => new sfWidgetFormInput(),
      'delivery_last_name'    => new sfWidgetFormInput(),
      'delivery_country_id'   => new sfWidgetFormPropelSelect(array('model' => 'Country', 'add_empty' => true)),
      'delivery_state_id'     => new sfWidgetFormPropelSelect(array('model' => 'State', 'add_empty' => true)),
      'delivery_state_title'  => new sfWidgetFormInput(),
      'delivery_city'         => new sfWidgetFormInput(),
      'delivery_street'       => new sfWidgetFormInput(),
      'delivery_postcode'     => new sfWidgetFormInput(),
      'comment'               => new sfWidgetFormInput(),
      'status_id'             => new sfWidgetFormPropelSelect(array('model' => 'OrderStatus', 'add_empty' => true)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'OrderItem', 'column' => 'id', 'required' => false)),
      'uuid'                  => new sfValidatorString(array('max_length' => 32)),
      'delivery_id'           => new sfValidatorPropelChoice(array('model' => 'Delivery', 'column' => 'id', 'required' => false)),
      'delivery_method_title' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'delivery_description'  => new sfValidatorString(array('required' => false)),
      'delivery_price'        => new sfValidatorNumber(array('required' => false)),
      'member_id'             => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id')),
      'member_first_name'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'member_last_name'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'member_country_id'     => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'member_state_id'       => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'member_state_title'    => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'member_city'           => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'member_street'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'member_postcode'       => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'billing_first_name'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'billing_last_name'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'billing_country_id'    => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'billing_state_id'      => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'billing_state_title'   => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'billing_city'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'billing_street'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'billing_postcode'      => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'delivery_first_name'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'delivery_last_name'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'delivery_country_id'   => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'delivery_state_id'     => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'delivery_state_title'  => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'delivery_city'         => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'delivery_street'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'delivery_postcode'     => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'comment'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status_id'             => new sfValidatorPropelChoice(array('model' => 'OrderStatus', 'column' => 'id', 'required' => false)),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'OrderItem', 'column' => array('uuid')))
    );

    $this->widgetSchema->setNameFormat('order_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderItem';
  }


}
