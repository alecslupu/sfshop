<?php

/**
 * Session form base class.
 *
 * @package    form
 * @subpackage session
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseSessionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cid'      => new sfWidgetFormInputHidden(),
      'ses_data' => new sfWidgetFormTextarea(),
      'ses_time' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'cid'      => new sfValidatorPropelChoice(array('model' => 'Session', 'column' => 'cid', 'required' => false)),
      'ses_data' => new sfValidatorString(),
      'ses_time' => new sfValidatorDateTime(array('required' => false)),
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
