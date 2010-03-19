<?php

/**
 * State filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseStateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'country_id'    => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => true)),
      'iso'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title_english' => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'country_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Country', 'column' => 'id')),
      'iso'           => new sfValidatorPass(array('required' => false)),
      'title_english' => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('state_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'State';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'country_id'    => 'ForeignKey',
      'iso'           => 'Text',
      'title_english' => 'Text',
      'is_active'     => 'Boolean',
    );
  }
}
