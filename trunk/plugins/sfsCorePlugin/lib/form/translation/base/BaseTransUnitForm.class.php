<?php

/**
 * TransUnit form base class.
 *
 * @package    form
 * @subpackage trans_unit
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTransUnitForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'cat_id'        => new sfWidgetFormPropelSelect(array('model' => 'Catalogue', 'add_empty' => false)),
      'source'        => new sfWidgetFormTextarea(),
      'target'        => new sfWidgetFormTextarea(),
      'comments'      => new sfWidgetFormTextarea(),
      'date_added'    => new sfWidgetFormInput(),
      'date_modified' => new sfWidgetFormInput(),
      'author'        => new sfWidgetFormInput(),
      'translated'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'TransUnit', 'column' => 'id', 'required' => false)),
      'cat_id'        => new sfValidatorPropelChoice(array('model' => 'Catalogue', 'column' => 'cat_id')),
      'source'        => new sfValidatorString(),
      'target'        => new sfValidatorString(),
      'comments'      => new sfValidatorString(array('required' => false)),
      'date_added'    => new sfValidatorInteger(),
      'date_modified' => new sfValidatorInteger(),
      'author'        => new sfValidatorString(array('max_length' => 255)),
      'translated'    => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('trans_unit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransUnit';
  }


}
