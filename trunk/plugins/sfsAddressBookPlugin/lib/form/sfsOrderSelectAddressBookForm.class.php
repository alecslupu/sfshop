<?php

/**
 * sfsOrderSelectAddressBookForm form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage form
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsOrderSelectAddressBookForm extends AddressBookForm
{
    public function configure()
    {
        parent::configure();
        
        $arrayAddresses = AddressBookPeer::getHashByMemberId(sfContext::getInstance()->getUser()->getUserId());
        
        if (count($arrayAddresses) > 0) {
            $this->setWidgets(
                array('address_id' => new sfWidgetFormSelect(array('choices' => $arrayAddresses)))
            );
            
            $this->widgetSchema->setLabel('address_id', ' ');
            
            $validatorAddressId = new sfValidatorChoice(
                array('choices' => $arrayAddresses)
            );
            
            $this->setValidators(array('address_id' => $validatorAddressId));
        }
        $this->getWidgetSchema()->setNameFormat('address[%s]');
    }
}
