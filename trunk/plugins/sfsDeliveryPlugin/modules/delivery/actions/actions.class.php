<?php
/**
 * delivery actions.
 *
 * @package    sfShop
 * @subpackage delivery
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class deliveryActions extends sfActions
{
   /**
    * Show all available delivery methods with form for choose some.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeCheckout($request)
    {
        sfLoader::loadHelpers(array('Asset', 'Tag'));
        
        $sfUser = $this->getUser();
        $criteria = new Criteria();
        DeliveryPeer::addPublicCriteria($criteria);
        $this->deliveryServices = DeliveryPeer::getAll($criteria);
        
        $deliveryAddress = $sfUser->getAttribute('address', null, 'order/delivery');
        
        if ($deliveryAddress != null) {
            $deliveryAddress['country_iso'] = CountryPeer::retrieveByPK($deliveryAddress['country_id'])->getIso();
            $deliveryAddress['state_iso'] = StatePeer::retrieveByPK($deliveryAddress['state_id'])->getIso();
            
            $weight = $sfUser->getBasket()->getTotalWeight();
            $price = $sfUser->getBasket()->getTotalPrice();
            $cude = $sfUser->getBasket()->getTotalCube();
            
            $this->form = new sfsOrderSelectDeliveryForm();
            
            $choices = array();
            $sectionsWithChoices = array();
            
            foreach ($this->deliveryServices as $deliveryService) {
                
                $className = $deliveryService->getClassName();
                
                $sectionsWithChoices[$deliveryService->getId()]['title'] = $deliveryService->getTitle();
                
                if ($deliveryService->getIcon()) {
                    $icon = image_tag(sfConfig::get('app_icons_delivery_web_dir') . '/' . $deliveryService->getIcon(), array('align' => 'absmiddle'));
                    $sectionsWithChoices[$deliveryService->getId()]['icon'] = $icon;
                }
                
                if (class_exists($className)) {
                    $params = sfsJSONPeer::decode($deliveryService->getParams());
                    
                    if (isset($params['original_address'])) {
                        $params['original_address']['country_iso'] = CountryPeer::retrieveByPK($params['original_address']['country_id'])->getIso();
                        $params['original_address']['state_iso'] = StatePeer::retrieveByPK($params['original_address']['state_id'])->getIso();
                    }
                    
                    $service = new $className($params);
                }
                else {
                    throw new Exception('The class for delivery rate with name ' . $className . ' not found!');
                }
                
                $methods = $service->getQuote($deliveryAddress, $weight, $cude, 1, $price);
                
                if ($service->isErrorSet()) {
                    $errors = $service->getErrors();
                    
                    $errorsStr = '';
                    
                    foreach ($errors as $error) {
                        $errorsStr .= $error;
                    }
                    
                    throw new Exception($errorsStr);
                }
                
                foreach ($methods as $method) {
                    $sectionsWithChoices[$deliveryService->getId()]['choices'][$deliveryService->getId() . '_' . $method['id']] = $method;
                    $choices[$deliveryService->getId() . '_' . $method['id']] = $method;
                }
            }
            
            $validator = new sfValidatorChoice(
                array('choices'  => $choices),
                array('required' => 'You should select delivery method')
            );
            
            $sfUser->setAttribute('methods', $sectionsWithChoices, 'order/delivery');
            
            $this->form->getWidgetSchema()->offsetSet('method_id', new sfsWidgetFormSelectRadioServicesList(array('choices' => $sectionsWithChoices)));
            $this->form->getValidatorSchema()->offsetSet('method_id', $validator);
            
            $defaultMethodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
            $this->form->setDefault('method_id', $defaultMethodId);
            
            if ($request->isMethod('post')) {
                $data = $request->getParameter('delivery');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    $sfUser->setAttribute('method_id', $data['method_id'], 'order/delivery');
                    $this->redirect('@order_checkoutConfirmation');
                }
            }
        }
        else {
            $this->redirect('@basket_list');
        }
    }
}
