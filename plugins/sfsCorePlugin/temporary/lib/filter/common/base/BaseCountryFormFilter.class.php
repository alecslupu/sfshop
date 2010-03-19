<?php

/**
 * Country filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_a3'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iso_n'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title_english' => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'iso'           => new sfValidatorPass(array('required' => false)),
      'iso_a3'        => new sfValidatorPass(array('required' => false)),
      'iso_n'         => new sfValidatorPass(array('required' => false)),
      'title_english' => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'iso'           => 'Text',
      'iso_a3'        => 'Text',
      'iso_n'         => 'Text',
      'title_english' => 'Text',
      'is_active'     => 'Boolean',
    );
  }
}
