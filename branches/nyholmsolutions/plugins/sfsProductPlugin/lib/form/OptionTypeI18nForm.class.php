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
 * OptionTypeI18n form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class OptionTypeI18nForm extends BaseOptionTypeI18nForm
{
    public function configure()
    {
        parent::configure();
        
        $widgetDescription = new sfWidgetFormTextarea(
            array(),
            array('cols' => 80, 'rows' => 5)
        );
        
        $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 80)));
        $this->setWidget('description', $widgetDescription);
        
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
            array(
                'required'   => false,
                'max_length' => 300
            ),
            array('max_length' => 'Description can not be more 300 characters')
        );
        
        $this->setValidator('title', $validatorTitle);
        $this->setValidator('description', $validatorDescription);
    }
}
