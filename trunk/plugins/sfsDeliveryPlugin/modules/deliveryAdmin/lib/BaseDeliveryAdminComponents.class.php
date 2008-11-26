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
 * Delivery components.
 *
 * @package    plugins.sfsDeliveryPlugin
 * @subpackage modules.delivery
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseDeliveryAdminComponents extends sfComponents
{
   /**
    * Delivery method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeOrderDeliveryInfo()
    {
        $sfUser = $this->getUser();
        
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
    
   /**
    * Form for select some delivery service.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
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
