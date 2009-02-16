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
 * CurrencyI18n form.
 *
 * @package    plugin.sfsCurrencyPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class CurrencyI18nForm extends BaseCurrencyI18nForm
{
    public function configure()
    {
        parent::configure();
        $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 50)));
        
        $titleValidator = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 128
            ),
            array(
                'required'   => 'Title is a required field',
                'max_length' => 'Title can not be more 128 characters'
            )
        );
        
        $this->setValidator('title', $titleValidator);
    }
}
