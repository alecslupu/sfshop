<?php

/**
 * AssetType filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseAssetTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'model'         => new sfWidgetFormFilterInput(),
      'has_thumbnail' => new sfWidgetFormFilterInput(),
      'has_i18n'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'model'         => new sfValidatorPass(array('required' => false)),
      'has_thumbnail' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'has_i18n'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('asset_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AssetType';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'model'         => 'Text',
      'has_thumbnail' => 'Number',
      'has_i18n'      => 'Number',
    );
  }
}
