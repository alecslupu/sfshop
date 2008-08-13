<?php

/**
 * AddressBook form base class.
 *
 * @package    form
 * @subpackage address_book
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAddressBookForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'member_id'   => new sfWidgetFormPropelSelect(array('model' => 'Member', 'add_empty' => true)),
      'gender'      => new sfWidgetFormInput(),
      'first_name'  => new sfWidgetFormInput(),
      'last_name'   => new sfWidgetFormInput(),
      'company'     => new sfWidgetFormInput(),
      'country_id'  => new sfWidgetFormPropelSelect(array('model' => 'Country', 'add_empty' => true)),
      'state_id'    => new sfWidgetFormPropelSelect(array('model' => 'State', 'add_empty' => true)),
      'state_title' => new sfWidgetFormInput(),
      'city'        => new sfWidgetFormInput(),
      'street'      => new sfWidgetFormInput(),
      'postcode'    => new sfWidgetFormInput(),
      'is_default'  => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'AddressBook', 'column' => 'id', 'required' => false)),
      'member_id'   => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id', 'required' => false)),
      'gender'      => new sfValidatorInteger(array('required' => false)),
      'first_name'  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'last_name'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'company'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'country_id'  => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => false)),
      'state_id'    => new sfValidatorPropelChoice(array('model' => 'State', 'column' => 'id', 'required' => false)),
      'state_title' => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'city'        => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'street'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'postcode'    => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'is_default'  => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address_book[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AddressBook';
  }


}
