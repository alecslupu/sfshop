<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * CountryI18n filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseCountryI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CountryI18n';
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
