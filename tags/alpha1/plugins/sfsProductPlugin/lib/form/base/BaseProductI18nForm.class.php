<?php

/**
 * ProductI18n form base class.
 *
 * @package    form
 * @subpackage product_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseProductI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'culture'           => new sfWidgetFormInputHidden(),
      'title'             => new sfWidgetFormInput(),
      'description_short' => new sfWidgetFormTextarea(),
      'description'       => new sfWidgetFormTextarea(),
      'meta_keywords'     => new sfWidgetFormTextarea(),
      'meta_description'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
      'culture'           => new sfValidatorPropelChoice(array('model' => 'ProductI18n', 'column' => 'culture', 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description_short' => new sfValidatorString(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'meta_keywords'     => new sfValidatorString(array('required' => false)),
      'meta_description'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductI18n';
  }


}
