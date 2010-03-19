<?php

/**
 * Session form base class.
 *
 * @method Session getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseSessionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cid'      => new sfWidgetFormInputHidden(),
      'ses_data' => new sfWidgetFormTextarea(),
      'ses_time' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cid'      => new sfValidatorPropelChoice(array('model' => 'Session', 'column' => 'cid', 'required' => false)),
      'ses_data' => new sfValidatorString(),
      'ses_time' => new sfValidatorInteger(array('min' => -9.2233720368548E+18, 'max' => 9.2233720368548E+18, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('session[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Session';
  }


}
