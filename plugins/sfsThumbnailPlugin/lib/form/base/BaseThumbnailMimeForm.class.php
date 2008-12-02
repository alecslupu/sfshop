<?php

/**
 * ThumbnailMime form base class.
 *
 * @package    form
 * @subpackage thumbnail_mime
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseThumbnailMimeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mime'       => new sfWidgetFormInput(),
      'extension'  => new sfWidgetFormInput(),
      'extensions' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ThumbnailMime', 'column' => 'id', 'required' => false)),
      'mime'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'extension'  => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'extensions' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('thumbnail_mime[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ThumbnailMime';
  }


}
