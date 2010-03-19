<?php

/**
 * EmailTemplate form base class.
 *
 * @method EmailTemplate getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseEmailTemplateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'   => new sfWidgetFormInputHidden(),
      'name' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'   => new sfValidatorPropelChoice(array('model' => 'EmailTemplate', 'column' => 'id', 'required' => false)),
      'name' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_template[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailTemplate';
  }

  public function getI18nModelName()
  {
    return 'EmailTemplateI18n';
  }

  public function getI18nFormClass()
  {
    return 'EmailTemplateI18nForm';
  }

}
