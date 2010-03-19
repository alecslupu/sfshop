<?php

/**
 * AdminMenu filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAdminMenuFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id'  => new sfWidgetFormPropelChoice(array('model' => 'AdminMenu', 'add_empty' => true)),
      'credential' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'module'     => new sfWidgetFormFilterInput(),
      'action'     => new sfWidgetFormFilterInput(),
      'route'      => new sfWidgetFormFilterInput(),
      'pos'        => new sfWidgetFormFilterInput(),
      'is_active'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'parent_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AdminMenu', 'column' => 'id')),
      'credential' => new sfValidatorPass(array('required' => false)),
      'module'     => new sfValidatorPass(array('required' => false)),
      'action'     => new sfValidatorPass(array('required' => false)),
      'route'      => new sfValidatorPass(array('required' => false)),
      'pos'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('admin_menu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdminMenu';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'parent_id'  => 'ForeignKey',
      'credential' => 'Text',
      'module'     => 'Text',
      'action'     => 'Text',
      'route'      => 'Text',
      'pos'        => 'Number',
      'is_active'  => 'Boolean',
    );
  }
}
