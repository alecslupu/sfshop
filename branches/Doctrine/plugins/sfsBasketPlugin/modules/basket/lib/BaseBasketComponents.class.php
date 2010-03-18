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
 * Base basket components.
 *
 * @package    pugins.sfsBasketPlugin
 * @subpackage modules.basket
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseBasketComponents extends sfComponents
{
   /**
    * Form for add product to shopping cart with quantity.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeAddProductForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript(sfConfig::get('app_sfshop_core_js_dir').'sfsForm.js');
        $response->addJavaScript(sfConfig::get('app_sfshop_core_js_dir').'sfsBasketAddProductForm.js');
        
        if ($this->isShortForm) {
            $this->form = new sfsBasketAddProductShortForm();
        }
        else {
            $this->form = new sfsBasketAddProductForm();
        }
        
        $this->form->setDefault('product_id', $this->product->getId());
        
        if ($this->product->getHasOptions()) {
            $this->form->embedForm('options', $this->optionsForm);
        }
        else {
            $validatorQuantity = $this->form->getValidatorSchema()->offsetGet('quantity');
            $validatorQuantity->setOption('max', $this->product->getQuantity());
            
            $validatorQuantity->setMessage(
                'max', 
                str_replace('%max%', $this->product->getQuantity(), $validatorQuantity->getMessage('max'))
            );
            
            $this->productQuantity = $this->product->getQuantity();
            
            $basketProduct = BasketProductPeer::retrieveByBasketIdAndProductId($this->getUser()->getBasket()->getId(), $this->product->getId());
            
            if ($basketProduct !== null) {
                $this->addedQuantity = $basketProduct->getQuantity();
            }
        }
    }

    public function executeBasketInfo(sfWebRequest $request)
    {
    }
}
