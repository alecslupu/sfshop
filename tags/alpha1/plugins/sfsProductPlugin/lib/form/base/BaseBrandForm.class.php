<?php

/**
 * Brand form base class.
 *
 * @package    form
 * @subpackage brand
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBrandForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInput(),
      'url'        => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Brand', 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 128)),
      'url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Brand', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('brand[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brand';
  }

  public function getI18nModelName()
  {
    return 'BrandI18n';
  }

  public function getI18nFormClass()
  {
    return 'BrandI18nForm';
  }

}
