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
 * Base payment actions.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage lib.action
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsPaymentActions extends sfActions
{
    protected $orderItem = null;
    
   /**
    * Prexecuter calls function for check order status.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function preExecute()
    {
        $this->getContext()->getConfiguration()->loadHelpers(array('Url', 'sfsCurrency'));
        
        if ($this->getActionName() == 'index') {
            $this->checkOrderStatus();
        }
    }
    
   /**
    * Returns payment service object by by name or if name is not set, by method_id which retrieving from session.
    *
    * @param  string $name
    * @return object
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    protected function getPaymentServiceObject($name = '')
    {
        $criteria = new Criteria();
        PaymentPeer::addPublicCriteria($criteria);
        
        if ($name == '') {
            $paymentService = PaymentPeer::retrieveById($this->getUser()->getAttribute('method_id', null, 'order/payment'), $criteria);
        }
        else {
            $paymentService = PaymentPeer::retrieveByName($name, $criteria);
        }
        
        if ($paymentService == null) {
            $this->logMessage('Payment (' . ucfirst($paymentService->getName()) 
                . ' service): Some member to try use this service, but this service is inactive or does not exist.');
            $this->redirect('@payment_chargeFailed');
        }
        
        return $paymentService;
    }
    
   /**
    * Sets processing status for order.
    *
    * @param  sting $uuid
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    protected function setOrderStatusProcessing($uuid = '')
    {
        $request = $this->getRequest();
        
        if ($uuid == '') {
            $uuid = $request->getParameter('uuid');
        }
        
        $orderItem = $this->getOrderItemObjectByIdOrUuid($uuid);
        $orderItem->setStatusId(OrderStatusPeer::STATUS_PROCESSING);
        $orderItem->setPaymentAt(time());
        $orderItem->save();
    }
    
   /**
    * Gets order item object by uuid or id.
    *
    * @param  mixed $id
    * @return object
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    protected function getOrderItemObjectByIdOrUuid($id)
    {
        
        if ($this->orderItem == null) {
            
            if (preg_match('/^\d{1,}$/', $id, $res)) {
                $orderItem = OrderItemPeer::retrieveById($id);
            }
            else {
                $orderItem = OrderItemPeer::retrieveByUuid($id);
            }
            
            $this->forward404Unless($orderItem);
            $this->forward404Unless($orderItem->getMemberId() == $this->getUser()->getUserId());
            $this->orderItem = $orderItem;
        }
        
        return $this->orderItem;
    }
    
   /**
    * Check order status, if order is paid, the function will redirect to checkout finish page.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    protected function checkOrderStatus()
    {
        $orderItem = $this->getOrderItemObjectByIdOrUuid($this->getRequestParameter('order_item_id'));
        
        if ($orderItem->getStatusId() != OrderStatusPeer::STATUS_PENDING) {
            $this->redirect('@order_checkoutFinished');
        }
    }
    
   /**
    * Writes message to log file.
    *
    * @param  string $message
    * @param  int $logLevel
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function logMessage($message, $logLevel = sfLogger::ERR)
    {
        if (sfConfig::get('sf_logging_enabled')) {
            $logger = $this->getLogger();
            
            $request = $this->getRequest();
            $requestParameters = $request->getParameterHolder()->getAll();
            
            $logger->log($message . ' Request parameters: ' . str_replace("\n", '', var_export($requestParameters, true)), $logLevel);
        }
    }
}
