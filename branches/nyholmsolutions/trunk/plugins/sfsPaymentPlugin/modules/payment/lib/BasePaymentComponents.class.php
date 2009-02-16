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
 * Base payment components.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage modules.payment
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 */
class BasePaymentComponents extends sfComponents
{
   /**
    * Payment method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executePaymentInfo()
    {
        $sfUser = $this->getUser();
        
        if (isset($this->methodId)) {
            $id = $this->id;
        }
        else {
            $id = $sfUser->getAttribute('method_id', null, 'order/payment');
        }
        
        $criteria = new Criteria();
        $this->paymentService = PaymentPeer::retrieveById($id, new Criteria(), true);
        
        if ($this->paymentService == null) {
            sfContext::getInstance()->getController()->redirect('@payment_checkout');
        }
    }
    
   /**
    * Payment select form.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeSelectForm()
    {
        $this->form = new sfsPaymentSelectForm();
        
        $defaultMethodId = $this->getUser()->getAttribute('method_id', null, 'order/payment');
        $this->form->setDefault('method_id', $defaultMethodId);
        
        $this->paymentServices = $this->form->getPaymentServices();
    }
}
