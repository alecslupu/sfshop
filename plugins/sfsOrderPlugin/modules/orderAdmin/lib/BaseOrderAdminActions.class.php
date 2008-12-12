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
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseOrderAdminActions extends autoorderAdminActions
{
   /**
    * Order detail.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDetails()
    {
        $this->order = OrderItemPeer::retrieveById($this->getRequestParameter('id'));
        $this->forward404Unless($this->order);
        
        $addressArray = $this->order->getDeliveryAddress();
        $this->address = new AddressBook();
        $this->address->fromArray($addressArray, BasePeer::TYPE_FIELDNAME);
    }
    
   /**
    * Change status details.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeChangeStatus()
    {
        if ($this->getRequest()->isMethod('post')) {
            $order = OrderItemPeer::retrieveById($this->getRequestParameter('id'));
            $order->setStatusId($this->getRequestParameter('status_id'));
            $order->save();
        }
        
        $this->redirect($this->getRequest()->getReferer());
    }
    
    protected function addFiltersCriteria($c)
    {
        parent::addFiltersCriteria($c);
        /*
        if (isset($this->filters['member_full_name']) && $this->filters['member_full_name'] != '') {
            $m = "CONCAT(" . OrderItemPeer::MEMBER_FIRST_NAME . ", ' ', " . OrderItemPeer::MEMBER_LAST_NAME . ")";
            $c->add($m, $this->filters['member_full_name'], Criteria::LIKE);
        }
*/
    }
}
