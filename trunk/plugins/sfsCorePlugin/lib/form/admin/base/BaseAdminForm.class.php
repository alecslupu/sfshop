<?php

/**
 * Admin form base class.
 *
 * @package    form
 * @subpackage admin
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAdminForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'credential'  => new sfWidgetFormInput(),
      'username'    => new sfWidgetFormInput(),
      'password'    => new sfWidgetFormInput(),
      'first_name'  => new sfWidgetFormInput(),
      'last_name'   => new sfWidgetFormInput(),
      'email'       => new sfWidgetFormInput(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'access_num'  => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'modified_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Admin', 'column' => 'id', 'required' => false)),
      'credential'  => new sfValidatorString(array('max_length' => 255)),
      'username'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'password'    => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'first_name'  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'last_name'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(),
      'access_num'  => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'modified_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Admin', 'column' => array('username')))
    );

    $this->widgetSchema->setNameFormat('admin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Admin';
  }


}
