<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Basket add product form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.core.lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */

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
                'required'   => 'First name is required', 
                'min_length' => 'First name can not be less than 2 characters',
                'max_length' => 'First name can not be more than 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 2
            ),
            array(
                'required'   => 'Last name is required', 
                'min_length' => 'Last name can not be less than 2 characters',
                'max_length' => 'Last name can not be more than 255 characters',
            )
        );
        
        $validatorEmail = new sfValidatorEmail(
            array('required' => true), 
            array(
                'required'   => 'Email is required', 
                'invalid' => 'This is not a valid email address'
            )
        );
        
        $validatorSubject = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 5
            ),
            array(
                'required'   => 'Subject is required', 
                'min_length' => 'Subject can not be less than 5 characters'
            )
        );
        
        $validatorBody = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 5
            ),
            array(
                'required'   => 'Body is required', 
                'min_length' => 'Body can not be less than 5 characters'
            )
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
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        parent::configure();
    }
}
