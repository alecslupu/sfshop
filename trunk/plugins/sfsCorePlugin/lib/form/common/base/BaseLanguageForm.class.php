<?php

/**
 * Language form base class.
 *
 * @package    form
 * @subpackage language
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseLanguageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'culture'       => new sfWidgetFormInputHidden(),
      'title_english' => new sfWidgetFormInput(),
      'title_own'     => new sfWidgetFormInput(),
      'is_default'    => new sfWidgetFormInputCheckbox(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'culture'       => new sfValidatorPropelChoice(array('model' => 'Language', 'column' => 'culture', 'required' => false)),
      'title_english' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'title_own'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_default'    => new sfValidatorBoolean(),
      'is_active'     => new sfValidatorBoolean(),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
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
