<?php

/**
 * AdminMenu form base class.
 *
 * @package    form
 * @subpackage admin_menu
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAdminMenuForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'parent_id'  => new sfWidgetFormPropelSelect(array('model' => 'AdminMenu', 'add_empty' => true)),
      'credential' => new sfWidgetFormInput(),
      'title'      => new sfWidgetFormInput(),
      'route'      => new sfWidgetFormInput(),
      'pos'        => new sfWidgetFormInput(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'AdminMenu', 'column' => 'id', 'required' => false)),
      'parent_id'  => new sfValidatorPropelChoice(array('model' => 'AdminMenu', 'column' => 'id', 'required' => false)),
      'credential' => new sfValidatorString(array('max_length' => 255)),
      'title'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'route'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'pos'        => new sfValidatorInteger(array('required' => false)),
      'is_active'  => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('admin_menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdminMenu';
  }


}
