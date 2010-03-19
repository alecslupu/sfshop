<?php

/**
 * Language form base class.
 *
 * @method Language getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseLanguageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'culture'       => new sfWidgetFormInputText(),
      'title_english' => new sfWidgetFormInputText(),
      'title_own'     => new sfWidgetFormInputText(),
      'is_default'    => new sfWidgetFormInputCheckbox(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Language', 'column' => 'id', 'required' => false)),
      'culture'       => new sfValidatorString(array('max_length' => 7)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'title_own'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_default'    => new sfValidatorBoolean(),
      'is_active'     => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('language[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Language';
  }


}
