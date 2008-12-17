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
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class EmailTemplateI18nForm extends BaseEmailTemplateI18nForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'id'      => new sfWidgetFormInputHidden(),
            'culture' => new sfWidgetFormInputHidden(),
            'subject' => new sfWidgetFormInput(array(), array('size' => 80)),
            'body'    => new sfWidgetFormTextarea(
                array(),
                array('cols' => 110, 'rows' => 20)
             )
        ));
        
        $idValidator = new sfValidatorPropelChoice(
            array('model' => 'EmailTemplate', 'column' => 'id', 'required' => false)
        );
        
        $cultureValidator = new sfValidatorPropelChoice(
            array('model' => 'EmailTemplateI18n', 'column' => 'culture', 'required' => false)
        );
        
        $subjectValidator = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'Subject is a required field',
                'max_length' => 'Subject can not be more 255 characters'
            )
        );
        
        $bodyValidator = new sfValidatorString(
            array('required' => true),
            array('required' => 'Body is a required field')
        );
        
        $this->setValidators(array(
            'id'      => $idValidator,
            'culture' => $cultureValidator,
            'subject' => $subjectValidator,
            'body'    => $bodyValidator,
        ));
        
        $this->widgetSchema->setNameFormat('email_template_i18n[%s]');
    }
}
