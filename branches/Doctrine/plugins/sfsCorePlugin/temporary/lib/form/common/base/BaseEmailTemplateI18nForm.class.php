<?php

/**
 * EmailTemplateI18n form base class.
 *
 * @method EmailTemplateI18n getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseEmailTemplateI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
      'subject' => new sfWidgetFormInputText(),
      'body'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'EmailTemplate', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorPropelChoice(array('model' => 'EmailTemplateI18n', 'column' => 'culture', 'required' => false)),
      'subject' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_template_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailTemplateI18n';
  }


}
