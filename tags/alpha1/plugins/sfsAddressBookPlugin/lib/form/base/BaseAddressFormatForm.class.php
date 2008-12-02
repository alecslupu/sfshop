<?php

/**
 * AddressFormat form base class.
 *
 * @package    form
 * @subpackage address_format
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAddressFormatForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'location'   => new sfWidgetFormInputHidden(),
      'format'     => new sfWidgetFormTextarea(),
      'is_default' => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'AddressFormat', 'column' => 'id', 'required' => false)),
      'location'   => new sfValidatorPropelChoice(array('model' => 'AddressFormat', 'column' => 'location', 'required' => false)),
      'format'     => new sfValidatorString(array('required' => false)),
      'is_default' => new sfValidatorBoolean(),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address_format[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AddressFormat';
  }


}
