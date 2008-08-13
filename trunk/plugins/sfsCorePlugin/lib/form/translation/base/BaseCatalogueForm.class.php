<?php

/**
 * Catalogue form base class.
 *
 * @package    form
 * @subpackage catalogue
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCatalogueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cat_id'        => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'source_lang'   => new sfWidgetFormInput(),
      'target_lang'   => new sfWidgetFormInput(),
      'date_created'  => new sfWidgetFormInput(),
      'date_modified' => new sfWidgetFormInput(),
      'author'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'cat_id'        => new sfValidatorPropelChoice(array('model' => 'Catalogue', 'column' => 'cat_id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100)),
      'source_lang'   => new sfValidatorString(array('max_length' => 100)),
      'target_lang'   => new sfValidatorString(array('max_length' => 100)),
      'date_created'  => new sfValidatorInteger(),
      'date_modified' => new sfValidatorInteger(),
      'author'        => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('catalogue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogue';
  }


}
