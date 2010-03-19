<?php

/**
 * Language filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseLanguageFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'culture'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title_english' => new sfWidgetFormFilterInput(),
      'title_own'     => new sfWidgetFormFilterInput(),
      'is_default'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'culture'       => new sfValidatorPass(array('required' => false)),
      'title_english' => new sfValidatorPass(array('required' => false)),
      'title_own'     => new sfValidatorPass(array('required' => false)),
      'is_default'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('language_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Language';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'culture'       => 'Text',
      'title_english' => 'Text',
      'title_own'     => 'Text',
      'is_default'    => 'Boolean',
      'is_active'     => 'Boolean',
    );
  }
}
