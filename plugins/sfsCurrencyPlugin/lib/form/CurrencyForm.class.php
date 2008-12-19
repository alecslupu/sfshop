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
 * Currency form.
 *
 * @package    plugin.sfsCurrencyPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class CurrencyForm extends BaseCurrencyForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('created_at');
        $this->offsetUnset('updated_at');
        $this->offsetUnset('is_default');
        
        $this->setWidget('code', new sfWidgetFormInput(array(), array('size' => 4, 'maxlength' => 4)));
        
        $codeValidator = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 4
            ),
            array(
                'required'   => 'Code is a required field',
                'min_length' => 'Code must be 2 or more characters',
                'max_length' => 'Code can not be more 4 characters'
            )
        );
        
        $valueValidator = new sfValidatorNumber(
            array('required' => true),
            array('required' => 'Value is a required field')
        );
        
        $decimalPlaces = new sfValidatorNumber(
            array('required' => true),
            array('required' => 'Decimal places is a required field')
        );
        
        $this->setValidator('code', $codeValidator);
        $this->setValidator('value', $valueValidator);
        $this->setValidator('decimal_places', $decimalPlaces);
        
        $languages = LanguagePeer::getAllPublic();
        $cultures = array();
        
        foreach ($languages as $language) {
            $cultures[] = $language->getCulture();
        }
        
        $this->embedI18n($cultures);
        
        foreach ($languages as $language) {
            $this->getWidgetSchema()->setLabel($language->getCulture(), $language->getTitleEnglish());
        }
    }
}
