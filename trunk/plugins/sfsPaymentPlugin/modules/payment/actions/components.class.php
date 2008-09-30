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
 * Payment components.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage modules.payment
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 */
class paymentComponents extends sfComponents
{
   /**
    * Payment method info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeOrderPaymentMethod()
    {
        $sfUser = $this->getUser();
        
        $sectionsWithMethods = $sfUser->getAttribute('methods', null, 'order/payment');
        $methodId = $sfUser->getAttribute('method_id', null, 'order/payment');
        
        $criteria = new Criteria();
        $this->paymentService = PaymentPeer::retrieveById($methodId, $criteria, true);
        
        if ($this->paymentService == null) {
            sfContext::getInstance()->getController()->redirect('@payment_checkout');
        }
    }
}
