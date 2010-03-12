<?php

/**
 * Session filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseSessionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ses_data' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ses_time' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ses_data' => new sfValidatorPass(array('required' => false)),
      'ses_time' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('session_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Session';
  }

  public function getFields()
  {
    return array(
      'cid'      => 'Text',
      'ses_data' => 'Text',
      'ses_time' => 'Number',
    );
  }
}
