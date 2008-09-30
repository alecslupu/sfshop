<?php

/**
 * Product actions.
 *
 * @package    plugins.sfsProductsPlugin
 * @subpackage modules.product
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class productComponents extends sfComponents
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
            
            $this->optionsValues = array();
            
            foreach ($itemOptions as $itemOption) {
                $this->optionsValues[] = $itemOption->getOptionProduct()->getOptionValueJoinOptionType();
            }
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
}
