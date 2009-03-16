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
 * OptionValueI18n form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class OptionValueI18nForm extends BaseOptionValueI18nForm
{
    public function configure()
    {
        parent::configure();
        
        $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 80)));
        
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
        
        $this->setValidator('title', $validatorTitle);
    }
}
