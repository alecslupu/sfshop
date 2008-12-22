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
 * Base paymentAdmin components.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage modules.payment
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 */
class BasePaymentAdminComponents extends sfComponents
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
        $this->paymentService = PaymentPeer::retrieveById($this->id, new Criteria(), true);
    }
}
