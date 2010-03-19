<?php

/**
 * StateI18n filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseStateI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('state_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StateI18n';
  }

  public function getFields()
  {
    return array(
      'id'      => 'ForeignKey',
      'culture' => 'Text',
      'title'   => 'Text',
    );
  }
}
