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
 * OrderAdmin components.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage modules.orderAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id$
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
            $optionsValues = array();
            
            foreach ($this->orderProduct->getOrderProduct2OptionProducts() as $itemOption) {
                $optionsValues[] = $itemOption->getOptionProduct()->getOptionValueJoinOptionType();
            }
            $this->optionsValues = $optionsValues;
        }
    }
}
