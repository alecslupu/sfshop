<?php

/**
 * EmailTemplateI18n form base class.
 *
 * @package    form
 * @subpackage email_template_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseEmailTemplateI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
      'subject' => new sfWidgetFormInput(),
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
