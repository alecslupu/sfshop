<?php
class RegisterForm extends sfGuardUserForm
{
  public function configure()
  {
    // Remove all widgets we don't want to show
    unset(
      $this['password'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['updated_at'],
      $this['groups_list'],
      $this['permissions_list'],
      $this['last_login'],
      $this['created_at'],
      $this['salt'],
      $this['algorithm']
    );

    $this->widgetSchema->setFormFormatterName('list');
    $this->widgetSchema->setNameFormat('sfs_register[%s]');
   
    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')),array('invalid'=>'Same "%column%" already exists.')),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email')),array('invalid'=>'Same "%column%" already exists.')),
      ))
    );
    
    // Setup proper password validation with confirmation
    //$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    //$this->validatorSchema['password']->setOption('required', true);
    
    //$this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
    //$this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
    
    //$this->widgetSchema->moveField('password_confirmation', 'after', 'password');
    //$this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'The two passwords must be the same.')));

    //$profileForm = new ProfileForm($this->object->Profile);
    //$profileForm->getWidgetSchema()->setFormFormatterName('list');

    //unset($profileForm['id'], $profileForm['sf_guard_user_id'], $profileForm['created_at'], $profileForm['updated_at']);
    //$this->embedForm('Profile', $profileForm);

  }
}
?>
