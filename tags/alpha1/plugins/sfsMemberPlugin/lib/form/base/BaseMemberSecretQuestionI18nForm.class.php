<?php

/**
 * MemberSecretQuestionI18n form base class.
 *
 * @package    form
 * @subpackage member_secret_question_i18n
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseMemberSecretQuestionI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'culture'  => new sfWidgetFormInputHidden(),
      'question' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'MemberSecretQuestion', 'column' => 'id', 'required' => false)),
      'culture'  => new sfValidatorPropelChoice(array('model' => 'MemberSecretQuestionI18n', 'column' => 'culture', 'required' => false)),
      'question' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('member_secret_question_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MemberSecretQuestionI18n';
  }


}
