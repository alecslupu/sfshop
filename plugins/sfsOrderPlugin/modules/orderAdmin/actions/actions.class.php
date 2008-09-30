<?php

/**
 * orderAdmin actions.
 *
 * @package    sfShop
 * @subpackage orderAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class orderAdminActions extends autoorderAdminActions
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
