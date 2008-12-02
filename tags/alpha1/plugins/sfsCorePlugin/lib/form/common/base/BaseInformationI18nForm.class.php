<?php

/**
 * InformationI18n form base class.
 *
 * @package    form
 * @subpackage information_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseInformationI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'culture'          => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInput(),
      'description'      => new sfWidgetFormTextarea(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'meta_description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Information', 'column' => 'id', 'required' => false)),
      'culture'          => new sfValidatorPropelChoice(array('model' => 'InformationI18n', 'column' => 'culture', 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'meta_keywords'    => new sfValidatorString(array('required' => false)),
      'meta_description' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('information_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InformationI18n';
  }


}
