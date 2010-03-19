<?php

/**
 * AdminMenu form base class.
 *
 * @method AdminMenu getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAdminMenuForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'parent_id'  => new sfWidgetFormPropelChoice(array('model' => 'AdminMenu', 'add_empty' => true)),
      'credential' => new sfWidgetFormInputText(),
      'module'     => new sfWidgetFormInputText(),
      'action'     => new sfWidgetFormInputText(),
      'route'      => new sfWidgetFormInputText(),
      'pos'        => new sfWidgetFormInputText(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'AdminMenu', 'column' => 'id', 'required' => false)),
      'parent_id'  => new sfValidatorPropelChoice(array('model' => 'AdminMenu', 'column' => 'id', 'required' => false)),
      'credential' => new sfValidatorString(array('max_length' => 255)),
      'module'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'action'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'route'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'pos'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_active'  => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('admin_menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdminMenu';
  }

  public function getI18nModelName()
  {
    return 'AdminMenuI18n';
  }

  public function getI18nFormClass()
  {
    return 'AdminMenuI18nForm';
  }

}
