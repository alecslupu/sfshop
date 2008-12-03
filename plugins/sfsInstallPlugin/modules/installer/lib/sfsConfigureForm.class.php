<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Select delivery service form.
 *
 * @package    plugin.sfsInstallPlugin
 * @subpackage modules.installer
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
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
        
        $this->getWidgetSchema()->setHelp('database_name', 'Database must be exists before continue installation.');
        
        $validatorDatabaseHost = new sfValidatorString(
            array('required' => true),
            array('required' => 'Database host is a required field')
        );
        
        $validatorDatabaseName = new sfValidatorString(
            array('required' => true),
            array('required' => 'Database name is a required field')
        );
        
        $validatorDatabaseUsername = new sfValidatorString(
            array('required' => true),
            array('required' => 'Database username is a required field')
        );
        
        $this->setValidators(
            array(
                'database_host'     => $validatorDatabaseHost,
                'database_name'     => $validatorDatabaseName,
                'database_username' => $validatorDatabaseUsername,
                'database_password' => new sfValidatorString(array('required' => false))
            )
        );
        
        $this->widgetSchema->setNameFormat('data[%s]');
    }
}
