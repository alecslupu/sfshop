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
 * AddressBookShort form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsOrderInputAddressBookForm extends AddressBookForm
{
    public function configure()
    {
        parent::configure();
        
        //$this->getWidgetSchema()->offsetUnset('gender');
        $this->getWidgetSchema()->offsetUnset('is_default');
        
        //$this->getValidatorSchema()->offsetUnset('gender');
        $this->getValidatorSchema()->offsetUnset('is_default');
    }
}