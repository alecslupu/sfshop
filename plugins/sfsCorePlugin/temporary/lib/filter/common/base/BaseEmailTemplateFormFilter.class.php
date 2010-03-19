<?php

/**
 * EmailTemplate filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseEmailTemplateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_template_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailTemplate';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'name' => 'Text',
    );
  }
}
