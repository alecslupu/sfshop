<?php

class sfsConfigureForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'database_host'     => new sfWidgetFormInput(),
                'database_name'     => new sfWidgetFormInput(),
                'database_username' => new sfWidgetFormInput(),
                'database_password' => new sfWidgetFormInputPassword(array('always_render_empty' => true))
            )
        );
        
        $this->setDefault('database_host', 'localhost');
        
        $validatorDatabaseHost = new sfValidatorString(
            array('required' => true),
            array('required' => 'Database host is a required field')
        );
        
        $validatorDatabaseName = new sfValidatorString(
            array('required' => true),
            array('required' => 'Database name is a required field')
        );
        
        $this->setValidators(
            array(
                'database_host'     => $validatorDatabaseHost,
                'database_name'     => $validatorDatabaseName,
                'database_username' => new sfValidatorString(),
                'database_password' => new sfValidatorString(array('required' => false))
            )
        );
        
        $this->widgetSchema->setNameFormat('data[%s]');
    }
}
