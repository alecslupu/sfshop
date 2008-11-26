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
 * OrderAdmin components.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage modules.orderAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseOrderAdminComponents extends sfComponents
{
   /**
    * Gets product options list.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeProductOptionsList()
    {
        $product = $this->orderProduct->getProduct();
        
        if ($product->getHasOptions()) {
            $this->optionsValues = array();
            
            foreach ($this->orderProduct->getOrderProduct2OptionProducts() as $itemOption) {
                $this->optionsValues[] = $itemOption->getOptionProduct()->getOptionValueJoinOptionType();
            }
        }
    }
    
   /**
    * Gets order statuses.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeOrderStatusSelect()
    {
         $criteria = new Criteria();
         OrderStatusPeer::addAdminCriteria($criteria);
         $statuses = OrderStatusPeer::getAll($criteria, true);
         $this->options = array();
         $this->selected = $this->order->getStatusId();
         
         foreach ($statuses as $status) {
             $this->options[$status->getId()] = $status->getTitle();
         }
    }
}
