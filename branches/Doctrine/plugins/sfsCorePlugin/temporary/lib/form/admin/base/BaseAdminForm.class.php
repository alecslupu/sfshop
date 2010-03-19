<?php

/**
 * Admin form base class.
 *
 * @method Admin getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAdminForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'credential'  => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'algorithm'   => new sfWidgetFormInputText(),
      'salt'        => new sfWidgetFormInputText(),
      'password'    => new sfWidgetFormInputText(),
      'first_name'  => new sfWidgetFormInputText(),
      'last_name'   => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'access_num'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'modified_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Admin', 'column' => 'id', 'required' => false)),
      'credential'  => new sfValidatorString(array('max_length' => 255)),
      'email'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'algorithm'   => new sfValidatorString(array('max_length' => 32)),
      'salt'        => new sfValidatorString(array('max_length' => 128)),
      'password'    => new sfValidatorString(array('max_length' => 128)),
      'first_name'  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'last_name'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(),
      'access_num'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'modified_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Admin', 'column' => array('email')))
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
