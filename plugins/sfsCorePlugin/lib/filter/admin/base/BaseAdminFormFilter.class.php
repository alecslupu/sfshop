<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Admin filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseAdminFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credential'  => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'password'    => new sfWidgetFormFilterInput(),
      'first_name'  => new sfWidgetFormFilterInput(),
      'last_name'   => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'access_num'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'modified_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'credential'  => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
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
