<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Country filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'           => new sfWidgetFormFilterInput(),
      'iso_a3'        => new sfWidgetFormFilterInput(),
      'iso_n'         => new sfWidgetFormFilterInput(),
      'title_english' => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'iso'           => new sfValidatorPass(array('required' => false)),
      'iso_a3'        => new sfValidatorPass(array('required' => false)),
      'iso_n'         => new sfValidatorPass(array('required' => false)),
      'title_english' => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
