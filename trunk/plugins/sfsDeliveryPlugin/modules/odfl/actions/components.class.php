<?php

/**
 * Odfl components.
 *
 * @package    sfShop
 * @subpackage odfl
 * @author     Dmitry Nesteruk
 */

require_once(dirname(__FILE__).'/../lib/sfsODFLRate.class.php');

class odflComponents extends sfComponents
{
    public function executeRate()
    {
        
        $className = strtolower(get_class($this->object));
        
        $params = array();
        $params['oZip'] = sfConfig::get('app_shipping_odfl_oZip');
        $params['oCity'] = sfConfig::get('app_shipping_odfl_oCity');
        $params['oState'] = sfConfig::get('app_shipping_odfl_oState');
        $params['oCountry'] = sfConfig::get('app_shipping_odfl_oCountry');
        
        $params['inboundOutbound'] = sfConfig::get('app_shipping_odfl_inboundOutbound');
        $params['discountRate'] = sfConfig::get('app_shipping_odfl_discountRate');
        
        $params['user'] = 'none';
        $params['pWord'] = 'none';
        $params['account'] = 'none';
        
        $params['intTerminal'] = sfConfig::get('app_shipping_odfl_intTerminal');
        $params['currency'] = sfConfig::get('app_shipping_odfl_currency');
        $params['refNumber'] = sfConfig::get('app_shipping_odfl_refNumber');
        
        $params['accessorials'] = array('n', 'n', 'n', 'n', 'n', 'n');
        
        if ($className == 'basket' || $className == 'orderitem') {
            $params['weights'] = array(ceil($this->object->getTotalWeight()), 0, 0, 0, 0);
            $params['classes'] = array(55, 0, 0, 0, 0);
            $params['cube'] = ceil($this->object->getTotalCube());
        } 
        else {
            sfContext::getInstance()->getUser()->setFlash('message', 'Server Internal error');
            sfContext::getInstance()->getController()->redirect('@basket_list');
        }
        
        if ($className == 'basket') {
            $address = sfContext::getInstance()->getUser()->getAttribute('address', null, 'order/delivery');
            $params['dZip'] = $address['postcode'];
            $params['dCity'] = $address['city'];
            
            if ($address['state_id']) {
                $state = StatePeer::retrieveByPK($address['state_id'])->getIso();
            }
            else {
                $state = $address['state_title'];
            }
            
            $params['dState'] = $state;
            $params['dCountry'] = CountryPeer::retrieveByPK($address['country_id'])->getIsoA3();
        }
        
        if ($className == 'orderitem') {
            $params['user'] = sfConfig::get('app_shipping_odfl_user');
            $params['pWord'] = sfConfig::get('app_shipping_odfl_pWord');
            $params['account'] = sfConfig::get('app_shipping_odfl_account');
            
            $params['dZip'] = $object->getDeliveryPostcode();
            $params['dCity'] = $object->getDeliveryCity();
            
            if ($address['state_id']) {
                $state = StatePeer::retrieveByPK($object->getDeliveryStateId())->getIso();
            }
            else {
                $state = $object->getDeliveryStateTitle();
            }
            
            $params['dState'] = $state;
            $params['dCountry'] = CountryPeer::retrieveByPK($object->getDeliveryCountryId())->getIsoA3();
        }
        
        $this->odflRate = new sfsODFLRate();
        $this->odflRate->call_calculateRate($params);
        
        if ($this->odflRate->calculateRate('validationError')) {
            
            $message = '';
            $codes = $this->odflRate->calculateRate('validationErrorCodes');
            
            if (!is_array($codes)) {
                $codes = array($codes);
            }
            
            $errors = array();
            
            foreach ($codes as $errorCode) {
                $errors[] = $this->odflRate->getErrorMessage($errorCode);
                //$message .= '<br />' . $this->odflRate->getErrorMessage($errorCode);
            }
            print_r($errors); exit;
            $this->getUser()->getAttributeHolder()->add($errors, 'delivery/errors');
            $this->getController()->redirect('@basket_list');
        }
    }
}
