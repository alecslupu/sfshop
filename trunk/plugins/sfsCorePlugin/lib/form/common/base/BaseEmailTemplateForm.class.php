<?php

/**
 * EmailTemplate form base class.
 *
 * @package    form
 * @subpackage email_template
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseEmailTemplateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'EmailTemplate', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
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
