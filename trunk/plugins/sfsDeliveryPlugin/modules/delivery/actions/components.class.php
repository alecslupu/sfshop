<?php

/**
 * Delivery components.
 *
 * @package    sfShop
 * @subpackage delivery
 * @author     Dmitry Nesteruk
 */
class deliveryComponents extends sfComponents
{
   /**
    * Delivery method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeOrderDeliveryMethod()
    {
        $sfUser = $this->getUser();
        
        $sectionsWithMethods = $sfUser->getAttribute('methods', null, 'order/delivery');
        $methodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
        
        if ($sectionsWithMethods != null && $methodId != null) {
            list($section, $method) = $methodId;
            
            if (isset($sectionsWithMethods[$section]['title']) && isset($sectionsWithMethods[$section]['choices'][$methodId])) {
                $this->sectionTitle = $sectionsWithMethods[$section]['title'];
                
                if (isset($sectionsWithMethods[$section]['icon'])) {
                    $this->sectionIcon = $sectionsWithMethods[$section]['icon'];
                }
                
                $this->methodTitle = $sectionsWithMethods[$section]['choices'][$methodId]['title'];
                $this->methodPrice = $sectionsWithMethods[$section]['choices'][$methodId]['price'];
                $sfUser->setAttribute('price', $this->methodPrice, 'order/delivery');
            }
            else {
                sfContext::getInstance()->getController()->redirect('@delivery_checkout');
            }
        }
        else {
            sfContext::getInstance()->getController()->redirect('@delivery_checkout');
        }
    }
}
