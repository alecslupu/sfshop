<?php

/**
 * sfsThumbnailSize form base class.
 *
 * @package    form
 * @subpackage sfs_thumbnail_size
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasesfsThumbnailSizeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'thumbnail_type_id' => new sfWidgetFormPropelSelect(array('model' => 'sfsThumbnailType', 'add_empty' => false)),
      'width'             => new sfWidgetFormInput(),
      'height'            => new sfWidgetFormInput(),
      'is_active'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'sfsThumbnailSize', 'column' => 'id', 'required' => false)),
      'thumbnail_type_id' => new sfValidatorPropelChoice(array('model' => 'sfsThumbnailType', 'column' => 'id')),
      'width'             => new sfValidatorInteger(array('required' => false)),
      'height'            => new sfValidatorInteger(array('required' => false)),
      'is_active'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sfs_thumbnail_size[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfsThumbnailSize';
  }


}
