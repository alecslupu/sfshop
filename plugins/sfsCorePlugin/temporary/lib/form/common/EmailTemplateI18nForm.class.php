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
 * EmailTemplateI18n form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: EmailTemplateI18nForm.class.php 443 2008-12-22 22:44:53Z nesterukd $
 */
class EmailTemplateI18nForm extends BaseEmailTemplateI18nForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidget('subject', new sfWidgetFormInput(array(), array('size' => 80)));
        $this->setWidget('body', new sfWidgetFormTextarea(array(), array('cols' => 110, 'rows' => 20)));
        
        $validatorSubject = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'Subject is a required field',
                'max_length' => 'Subject can not be more 255 characters'
            )
        );
        
        $validatorBody = new sfValidatorString(
            array('required' => true),
            array('required' => 'Body is a required field')
        );
        
        $this->setValidator('subject', $validatorSubject);
        $this->setValidator('body', $validatorBody);
    }
}
