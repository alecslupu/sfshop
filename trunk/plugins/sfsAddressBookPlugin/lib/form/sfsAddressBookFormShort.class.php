<?php

/**
 * AddressBookShort form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage form
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsAddressBookFormShort extends AddressBookForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetUnset('gender');
        $this->getWidgetSchema()->offsetUnset('first_name');
        $this->getWidgetSchema()->offsetUnset('last_name');
        $this->getWidgetSchema()->offsetUnset('is_default');
        
        $this->getValidatorSchema()->offsetUnset('gender');
        $this->getValidatorSchema()->offsetUnset('first_name');
        $this->getValidatorSchema()->offsetUnset('last_name');
        $this->getValidatorSchema()->offsetUnset('is_default');
        
        $this->getWidgetSchema()->offsetSet('is_default', new sfWidgetFormInputHidden());
        $this->setDefault('is_default', 1);
    }
}
