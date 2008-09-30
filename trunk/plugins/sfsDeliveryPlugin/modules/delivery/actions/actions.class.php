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
 * delivery actions.
 *
 * @package    plugins.sfsDeliveryPlugin
 * @subpackage modules.delivery
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class deliveryActions extends sfActions
{
   /**
    * Show all available delivery methods with form for choose some.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeCheckout($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        $sfUser = $this->getUser();
        $criteria = new Criteria();
        DeliveryPeer::addPublicCriteria($criteria);
        $this->deliveryServices = DeliveryPeer::getAll($criteria);
        $errors = array();
        $currencyCode = $sfUser->getBasket()->getCurrency()->getCode();
        $storeAddress = sfConfig::get('app_store_address');
        
        $storeAddress['country_iso'] = CountryPeer::retrieveByPK($storeAddress['country_id'])->getIso();
        $storeAddress['state_iso'] = StatePeer::retrieveByPK($storeAddress['state_id'])->getIso();
        
        $deliveryAddress = $sfUser->getAttribute('address', null, 'order/delivery');
        
        if ($deliveryAddress != null) {
            $deliveryAddress['country_iso'] = CountryPeer::retrieveByPK($deliveryAddress['country_id'])->getIso();
            $deliveryAddress['state_iso'] = StatePeer::retrieveByPK($deliveryAddress['state_id'])->getIso();
            
            $weight = $sfUser->getBasket()->getTotalWeight();
            $price = $sfUser->getBasket()->getTotalPrice();
            $cude = $sfUser->getBasket()->getTotalCube();
            $numBoxes = $sfUser->getBasket()->getTotalQuantity();
            $basketProducts = $sfUser->getBasket()->getBasketProductsJoinProduct();
            
            $this->form = new sfsOrderSelectDeliveryForm();
            
            $choices = array();
            $sections = array();
            $prices = array();
            
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
                    
                    $service->setDeliveryAddress($deliveryAddress);
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
                            $prices[$deliveryService->getId() . '_' . $method['id']] = $method['price'];
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
                        $logger = $this->getLogger();
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
            
            $this->form->getWidgetSchema()->offsetGet('method_id')->setOption('choices', $choices);
            $this->form->getValidatorSchema()->offsetGet('method_id')->setOption('choices', array_keys($choices));
            
            $defaultMethodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
            $this->form->setDefault('method_id', $defaultMethodId);
            
            if ($request->isMethod('post')) {
                $data = $request->getParameter('delivery');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    list($serviceId, $methodId) = explode('_', $data['method_id']);
                    $methodSubTitle = $choices[$data['method_id']];
                    
                    $methodPrice = $prices[$data['method_id']];
                    
                    $sfUser->setAttribute('method_id', $data['method_id'], 'order/delivery');
                    $sfUser->setAttribute('method_title', $methodSubTitle, 'order/delivery');
                    $sfUser->setAttribute('price', $methodPrice, 'order/delivery');
                    $this->redirect('@payment_checkout');
                }
            }
        }
        else {
            $this->redirect('@basket_list');
        }
    }
}
