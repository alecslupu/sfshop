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
 * Base delivery actions.
 *
 * @package    plugins.sfsDeliveryPlugin
 * @subpackage modules.delivery
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseDeliveryActions extends sfActions
{
   /**
    * Show all available delivery methods with form for choose some.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCheckout($request)
    {
        $this->getContext()->getConfiguration()->loadHelpers(array('I18N', 'sfsCurrency'));
        $sfUser = $this->getUser();
        
        $deliveryAddressId = $sfUser->getAttribute('address_id', null, 'order/delivery');
        $deliveryAddress = AddressBookPeer::retrieveById($deliveryAddressId);
        
        if ($deliveryAddress != null) {
            
            $this->form = new sfsDeliverySelectForm();
            
            $defaultMethodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
            $this->form->setDefault('method_id', $defaultMethodId);
            
            $this->errors = $this->form->getServiceErrors();
            $this->sections = $this->form->getSections();
            
            if ($request->isMethod('post')) {
                $data = $request->getParameter('data');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    list($serviceId, $methodId) = explode('_', $data['method_id'], 2);
                    
                    $serviceMethods = $this->sections[$serviceId];
                    
                    foreach ($serviceMethods['methods'] as $method) {
                        if ($method['id'] == $methodId) {
                            $methodSubTitle = $method['title'];
                            $methodPrice    = $method['price'];
                            $methodTax      = TaxRatePeer::calculateGrossPrice($method['price'], $method['tax_type_id'])-$method['price'];
                            $methodTaxType  = $method['tax_type_id'];
                            $methodTaxTitle = $method['tax_title'];
                        }
                    }
                    $sfUser->setAttribute('method_id', $data['method_id'], 'order/delivery');
                    $sfUser->setAttribute('method_title', $methodSubTitle, 'order/delivery');
                    $sfUser->setAttribute('price', $methodPrice, 'order/delivery');
                    $sfUser->setAttribute('tax', $methodTax, 'order/delivery');
                    $sfUser->setAttribute('tax_type_id', $methodTaxType, 'order/delivery');
                    $sfUser->setAttribute('tax_title', $methodTaxTitle, 'order/delivery');
                    
                    if ($request->isXmlHttpRequest()) {
                        
                        $deliveryService = $this->sections[$serviceId]['object'];
                        
                        if ($deliveryService->getIcon()) {
                            $serviceIconSrc = '/images/' . sfConfig::get('app_delivery_icons_dir') . '/' . $deliveryService->getIcon();
                        }
                        else {
                            $serviceIconSrc = '';
                        }
                        
                        $data = array(
                            'service_title'     => $deliveryService->getTitle(),
                            'service_icon_src'  => $serviceIconSrc,
                            'method_title'      => $methodSubTitle,
                            'price'             => format_currency($methodPrice +$methodTax),
/*                            'tax'               => $methodTax,
                            'tax_type_id'       => $methodTaxType,
                            'tax_title'         => $methodTaxTitle,
 */                           'total_price'       => format_currency($sfUser->getBasket()->getTotalPrice() + ($methodPrice + $methodTax))
                        );
                        
                        return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
                    }
                    else {
                        $this->redirect('@payment_checkout');
                    }
                }
                elseif ($request->isXmlHttpRequest()) {
                    $errors = array();
                    
                    foreach ($this->form->getErrorSchema() as $field => $error) {
                        $errors[$field] = $error->getMessage();
                    }
                    $sfUser->setAttribute('method_id', null, 'order/delivery');
                    return $this->renderText(sfsJSONPeer::createResponseError($errors));
                }
            }
        }
        else {
            $this->redirect('@basket_list');
        }
    }
    
   /**
    * Update select form.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeUpdateSelectForm()
    {
        $this->setLayout(false);
    }
}
