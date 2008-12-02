<?php

/**
 * Member form base class.
 *
 * @package    form
 * @subpackage member
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseMemberForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'credential'         => new sfWidgetFormInput(),
      'first_name'         => new sfWidgetFormInput(),
      'last_name'          => new sfWidgetFormInput(),
      'email'              => new sfWidgetFormInput(),
      'default_address_id' => new sfWidgetFormPropelSelect(array('model' => 'AddressBook', 'add_empty' => true)),
      'secret_question'    => new sfWidgetFormTextarea(),
      'secret_answer'      => new sfWidgetFormTextarea(),
      'primary_phone'      => new sfWidgetFormInput(),
      'secondary_phone'    => new sfWidgetFormInput(),
      'password'           => new sfWidgetFormInput(),
      'confirm_code'       => new sfWidgetFormInput(),
      'is_confirmed'       => new sfWidgetFormInputCheckbox(),
      'is_deleted'         => new sfWidgetFormInputCheckbox(),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'access_num'         => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'modified_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id', 'required' => false)),
      'credential'         => new sfValidatorString(array('max_length' => 255)),
      'first_name'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'last_name'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'default_address_id' => new sfValidatorPropelChoice(array('model' => 'AddressBook', 'column' => 'id', 'required' => false)),
      'secret_question'    => new sfValidatorString(array('required' => false)),
      'secret_answer'      => new sfValidatorString(array('required' => false)),
      'primary_phone'      => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'secondary_phone'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'password'           => new sfValidatorString(array('max_length' => 32)),
      'confirm_code'       => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'is_confirmed'       => new sfValidatorBoolean(),
      'is_deleted'         => new sfValidatorBoolean(),
      'is_active'          => new sfValidatorBoolean(),
      'access_num'         => new sfValidatorInteger(),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
      'modified_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Member', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('member[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Member';
  }


}
