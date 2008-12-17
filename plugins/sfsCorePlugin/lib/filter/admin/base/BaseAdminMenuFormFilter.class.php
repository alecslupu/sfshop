<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * AdminMenu filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseAdminMenuFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id'  => new sfWidgetFormPropelChoice(array('model' => 'AdminMenu', 'add_empty' => true)),
      'credential' => new sfWidgetFormFilterInput(),
      'title'      => new sfWidgetFormFilterInput(),
      'module'     => new sfWidgetFormFilterInput(),
      'action'     => new sfWidgetFormFilterInput(),
      'route'      => new sfWidgetFormFilterInput(),
      'pos'        => new sfWidgetFormFilterInput(),
      'is_active'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'parent_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AdminMenu', 'column' => 'id')),
      'credential' => new sfValidatorPass(array('required' => false)),
      'title'      => new sfValidatorPass(array('required' => false)),
      'module'     => new sfValidatorPass(array('required' => false)),
      'action'     => new sfValidatorPass(array('required' => false)),
      'route'      => new sfValidatorPass(array('required' => false)),
      'pos'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'title'      => 'Text',
      'module'     => 'Text',
      'action'     => 'Text',
      'route'      => 'Text',
      'pos'        => 'Number',
      'is_active'  => 'Boolean',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
