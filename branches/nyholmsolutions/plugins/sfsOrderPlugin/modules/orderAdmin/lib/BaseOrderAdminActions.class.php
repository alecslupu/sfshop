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
 * Base orderAdmin actions.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage modules.orderAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseOrderAdminActions extends autoorderAdminActions
{
   /**
    * Order details.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk, Andreas Nyholm
    * @access public
    */
    public function executeDetails($request)
    {
        $this->order = OrderItemPeer::retrieveById($request->getParameter('id'));
        $this->forward404Unless($this->order);
        
        $this->deliveryAddress = $this->order->getDeliveryAddress();
        $this->deliveryService = $this->order->getDeliveryService();
        $this->paymentService = $this->order->getPaymentService();
        $this->contactInfo = $this->order->getContactInfo();        

        $this->form = new sfsOrderChangeStatusForm($this->order);
        
        if ($request->isMethod('post')) {
            $data = $request->getParameter('order_item');
            
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                $this->form->save();
                $this->getUser()->setFlash('notice', 'The status was changed successfully.');
            }
        }
    }
}
