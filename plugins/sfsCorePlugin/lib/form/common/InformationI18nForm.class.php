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
 * InformationI18n form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InformationI18nForm extends BaseInformationI18nForm
{
    public function configure()
    {
        parent::configure();
        
        $widgetDescription = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 110,
              'rows'  => 20,
              'class' => 'mce-editor'
            )
        );
        
        $widgetMetaKeywords = new sfWidgetFormTextarea(
            array(),
            array('cols' => 80, 'rows' => 2)
        );
        
        $widgetMetaDescription = new sfWidgetFormTextarea(
            array(),
            array('cols' => 80, 'rows' => 5)
        );
        
        $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 80)));
        $this->setWidget('description', $widgetDescription);
        $this->setWidget('meta_keywords', $widgetMetaKeywords);
        $this->setWidget('meta_description', $widgetMetaDescription);
        
        $validatorTitle = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'Title is a required field',
                'max_length' => 'Title can not be more 255 characters'
            )
        );
        
        $validatorDescription = new sfValidatorString(
            array('required' => true),
            array('required' => 'Description is a required field')
        );
        
        $this->setValidator('title', $validatorTitle);
        $this->setValidator('description', $validatorDescription);
    }
}
