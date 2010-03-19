<?php

/**
 * Menu filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseMenuFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'  => new sfWidgetFormFilterInput(),
      'route' => new sfWidgetFormFilterInput(),
      'pos'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'type'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'route' => new sfValidatorPass(array('required' => false)),
      'pos'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menu';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'type'  => 'Number',
      'route' => 'Text',
      'pos'   => 'Number',
    );
  }
}
