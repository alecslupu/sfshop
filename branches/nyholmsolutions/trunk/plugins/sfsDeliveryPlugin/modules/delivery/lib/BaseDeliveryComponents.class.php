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
 * Delivery components.
 *
 * @package    plugins.sfsDeliveryPlugin
 * @subpackage modules.delivery
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseDeliveryComponents extends sfComponents
{
   /**
    * Delivery method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDeliveryInfo()
    {
        $sfUser = $this->getUser();
        
        if (isset($this->id)) {
            $this->deliveryService = DeliveryPeer::retrieveById($this->id, new Criteria(), true);
            $this->methodTitle = $this->method_title;
            $this->methodPrice = $this->method_price;
        }
        else {
            $methodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
            
            if ($methodId != null) {
                list($methodId, $subMethodId) = $methodId;
                
                $criteria = new Criteria();
                $this->deliveryService = DeliveryPeer::retrieveById($methodId, $criteria, true);
                
                if ($this->deliveryService == null) {
                    sfContext::getInstance()->getController()->redirect('@delivery_checkout');
                }
                
                $this->methodTitle =  $sfUser->getAttribute('method_title', null, 'order/delivery');
                $this->methodPrice = $sfUser->getAttribute('price', null, 'order/delivery');
            }
            else {
                sfContext::getInstance()->getController()->redirect('@delivery_checkout');
            }
        }
    }
    
   /**
    * Form for select some delivery service.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeSelectForm()
    {
        $this->form = new sfsDeliverySelectForm();
        
        $defaultMethodId = $this->getUser()->getAttribute('method_id', null, 'order/delivery');
        $this->form->setDefault('method_id', $defaultMethodId);
        
        $this->errors = $this->form->getServiceErrors();
        $this->sections = $this->form->getSections();
    }
}