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
 * Select delivery service form.
 *
 * @package    plugin.sfsDeliveryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsDeliverySelectForm extends BaseDeliveryForm
{
    protected $sections;
    protected $deliveryServices;
    protected $errors;
    protected $deliveryMethods;
    
    public function configure()
    {
        $sfUser = sfContext::getInstance()->getUser();
        $criteria = new Criteria();
        DeliveryPeer::addPublicCriteria($criteria);
        $this->deliveryServices = DeliveryPeer::getAll($criteria);
        
        $errors = array();
        $currencyCode = $sfUser->getBasket()->getCurrency()->getCode();
        $storeAddress = sfConfig::get('app_store_address');
        
        $storeAddress['country_iso'] = CountryPeer::retrieveByPK($storeAddress['country_id'])->getIso();
        $storeAddress['state_iso'] = StatePeer::retrieveByPK($storeAddress['state_id'])->getIso();
        
        $deliveryAddressId = $sfUser->getAttribute('address_id', null, 'order/delivery');
        $deliveryAddress = AddressBookPeer::retrieveById($deliveryAddressId);
        
        $deliveryAddressArray = $deliveryAddress->toArray(BasePeer::TYPE_FIELDNAME);
        $deliveryAddressArray['country_iso'] = CountryPeer::retrieveByPK($deliveryAddress->getCountryId())->getIso();
        $deliveryAddressArray['state_iso'] = StatePeer::retrieveByPK($deliveryAddress->getStateId())->getIso();
        
        $weight = $sfUser->getBasket()->getTotalWeight();
        $price = $sfUser->getBasket()->getTotalPrice();
        $cude = $sfUser->getBasket()->getTotalCube();
        $numBoxes = $sfUser->getBasket()->getTotalQuantity();
        $basketProducts = $sfUser->getBasket()->getBasketProductsJoinProduct();
        
        $choices = array();
        $sections = array();
        
        foreach ($this->deliveryServices as $deliveryService) {
            
            $acceptCurrenciesCodes = $deliveryService->getAcceptCurrenciesCodes();
            $arrayAcceptCurrenciesCodes = explode(',', $acceptCurrenciesCodes);
            
            if ($acceptCurrenciesCodes != '*' && !in_array($currencyCode, $arrayAcceptCurrenciesCodes)) {
                $criteria = new Criteria();
                CurrencyPeer::addPublicCriteria($criteria);
                $isExist = CurrencyPeer::checkExistenceByCodes($arrayAcceptCurrenciesCodes, $criteria);
            }
            else {
                $isExist = true;
            }
            
            if ($isExist) {
                $className = $deliveryService->getNameClassService();
                
                if (class_exists($className)) {
                    $params = sfsJSONPeer::decode($deliveryService->getParams());
                    
                    if (isset($params['original_address'])) {
                        $storeAddress['country_iso'] = CountryPeer::retrieveByPK($storeAddress['country_id'])->getIso();
                        $storeAddress['state_iso'] = StatePeer::retrieveByPK($storeAddress['state_id'])->getIso();
                    }
                    
                    $service = new $className($params);
                }
                else {
                    throw new Exception('The class for delivery rate with name ' . $className . ' not found!');
                }
                
                $service->setDeliveryAddress($deliveryAddressArray);
                $service->setStoreAddress($storeAddress);
                $service->setTotalWeight($weight);
                $service->setCube($cude);
                $service->setNumBoxes($numBoxes);
                $service->setItemProducts($basketProducts);
                $service->setTotalPrice($price);
                $methods = $service->getQuote();
                
                if ($service->isErrorSet()) {
                    $errors = array_merge($errors, $service->getErrors());
                }
                else if (is_array($methods) && count($methods) > 0) {
                    $sections[$deliveryService->getId()]['methods'] = $methods;
                    $sections[$deliveryService->getId()]['object'] = $deliveryService;
                    
                    foreach ($methods as $method) {
                        $choices[$deliveryService->getId() . '_' . $method['id']] = $method['title'];
                    }
                
                }
                else {
                    if (isset($unavailableServices)) {
                        $unavailableServices.= ', ' . $deliveryService->getTitle();
                    }
                    else {
                        $unavailableServices = $deliveryService->getTitle();
                    }
                }
            }
            else {
                if (sfConfig::get('sf_logging_enabled')) {
                    $logger = sfContext::getInstance()->getLogger();
                    $logger->err('Delivery checkout: The service "' . $deliveryService->getTitle() . '" can not be used on your store, '
                        . 'because the currencies which accept this service is not available. '
                        . 'Now this service has status inactive for change status you should add currency which accept this service '
                        . 'and than you may set status active in the section payment of admin panel. '
                        . 'This service is accept following currencies: ' . str_replace(',', ', ', $acceptCurrenciesCodes));
                }
                
                $deliveryService->setIsActive(false);
                $deliveryService->save();
            }
        }
        
        if (isset($unavailableServices)) {
            $errors[] = __('An error occured with the %title% shipping calculations. %title% may not 
                deliver to your country, or your postal code may be wrong.', array('%title%' => $unavailableServices));
        }
        
        $this->sections = $sections;
        
        if (count($errors) > 0) {
            $this->errors = $errors;
        }
        
        $this->setWidgets(
            array('method_id' => new sfWidgetFormSelectRadio(array('choices' => $choices, 'formatter'=> array('DeliveryForm','radioFormatter'))))
        );
        
        $this->widgetSchema->setLabel('method_id', 'Methods');
        
        $validatorMethodId = new sfValidatorChoice(
            array('choices' => array_keys($choices)),
            array('required' => 'Please select a some delivery method')
        );
        
        $this->setValidators(array('method_id' => $validatorMethodId));
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
    }
    
    public function getSections()
    {
        return $this->sections;
    }
    
    public function getServiceErrors()
    {
        return $this->errors;
    }
}
