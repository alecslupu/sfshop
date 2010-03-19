<?php

/**
 * Menu form base class.
 *
 * @method Menu getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseMenuForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'type'  => new sfWidgetFormInputText(),
      'route' => new sfWidgetFormInputText(),
      'pos'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorPropelChoice(array('model' => 'Menu', 'column' => 'id', 'required' => false)),
      'type'  => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'route' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'pos'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
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
