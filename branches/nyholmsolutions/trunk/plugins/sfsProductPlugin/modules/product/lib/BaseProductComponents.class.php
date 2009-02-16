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
 * Base product actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.product
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseProductComponents extends sfComponents
{
   /**
    * Gets product options list from itemProduct (BasketProduct or OrderProduct).
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeOptionsList()
    {
        $product = $this->itemProduct->getProduct();
        
        if ($product->getHasOptions()) {
            $itemOptions = call_user_func(
                array(
                    $this->itemProduct,
                    (string)$this->method_for_get_options
                ));
            
            // php 5.2.0 fix
            $optionsValues = array();
            
            foreach ($itemOptions as $itemOption) {
                $optionsValues[] = $itemOption->getOptionProduct()->getOptionValueJoinOptionType();
            }
            $this->optionsValues = $optionsValues;
        }
    }
    
   /**
    * Gets recent products list.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeRecent()
    {
        $this->products = ProductPeer::getRecent();
    }
    
   /**
    * Search short form.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeSearchShortForm()
    {
        $this->form = new sfsProductSearchShortForm();
    }
}
