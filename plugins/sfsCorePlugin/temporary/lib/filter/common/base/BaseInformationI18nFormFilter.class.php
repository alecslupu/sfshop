<?php

/**
 * InformationI18n filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseInformationI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'meta_keywords'    => new sfWidgetFormFilterInput(),
      'meta_description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'meta_keywords'    => new sfValidatorPass(array('required' => false)),
      'meta_description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('information_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InformationI18n';
  }

  public function getFields()
  {
    return array(
      'id'               => 'ForeignKey',
      'culture'          => 'Text',
      'title'            => 'Text',
      'description'      => 'Text',
      'meta_keywords'    => 'Text',
      'meta_description' => 'Text',
    );
  }
}
