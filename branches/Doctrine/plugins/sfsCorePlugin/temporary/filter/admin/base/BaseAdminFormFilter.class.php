<?php

/**
 * Admin filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAdminFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credential'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'       => new sfWidgetFormFilterInput(),
      'algorithm'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'  => new sfWidgetFormFilterInput(),
      'last_name'   => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'access_num'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modified_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'credential'  => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'algorithm'   => new sfValidatorPass(array('required' => false)),
      'salt'        => new sfValidatorPass(array('required' => false)),
      'password'    => new sfValidatorPass(array('required' => false)),
      'first_name'  => new sfValidatorPass(array('required' => false)),
      'last_name'   => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'access_num'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('admin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Admin';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'credential'  => 'Text',
      'email'       => 'Text',
      'algorithm'   => 'Text',
      'salt'        => 'Text',
      'password'    => 'Text',
      'first_name'  => 'Text',
      'last_name'   => 'Text',
      'is_active'   => 'Boolean',
      'access_num'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'modified_at' => 'Date',
    );
  }
}
