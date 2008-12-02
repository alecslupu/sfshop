<?php

/**
 * Menu form base class.
 *
 * @package    form
 * @subpackage menu
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseMenuForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInput(),
      'route'      => new sfWidgetFormInput(),
      'pos'        => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Menu', 'column' => 'id', 'required' => false)),
      'type'       => new sfValidatorInteger(array('required' => false)),
      'route'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'pos'        => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menu';
  }

  public function getI18nModelName()
  {
    return 'MenuI18n';
  }

  public function getI18nFormClass()
  {
    return 'MenuI18nForm';
  }

}
