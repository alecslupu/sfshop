<?php
class sfsContactUsForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'first_name' => new sfWidgetFormInput(),
                'last_name'  => new sfWidgetFormInput(),
                'email'      => new sfWidgetFormInput(),
                'subject'    => new sfWidgetFormInput(),
                'body'       => new sfWidgetFormTextarea()
             )
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 2
            ),
            array(
                'min_length' => 'First name can not be less 2 characters',
                'max_length' => 'First name number can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 4
            ),
            array(
                'min_length' => 'Last name can not be less 4 characters',
                'max_length' => 'Last name can not be more 255 characters',
            )
        );
        
        $validatorEmail = new sfValidatorEmail(
            array('required' => true), 
            array('invalid' => 'This is not a valid email address')
        );
        
        $validatorSubject = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 5
            ),
            array('min_length' => 'Subject can not be less 5 characters')
        );
        
        $validatorBody = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 10
            ),
            array('min_length' => 'Body can not be less 5 characters')
        );        
        
        $this->setValidators(
            array(
                'first_name' => $validatorFirstName,
                'last_name'  => $validatorLastName,
                'email'      => $validatorEmail,
                'subject'    => $validatorSubject,
                'body'       => $validatorBody
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
        parent::configure();
    }
}
