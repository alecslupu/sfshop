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
 * sfsOrderSelectAddressBookForm form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfsOrderSelectAddressBookForm.class.php 6174 2007-11-27 06:22:40Z fabien $
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
                array('choices' => array_keys($arrayAddresses))
            );
            
            $this->setValidators(array('address_id' => $validatorAddressId));
        }
        $this->getWidgetSchema()->setNameFormat('address[%s]');
    }
}
