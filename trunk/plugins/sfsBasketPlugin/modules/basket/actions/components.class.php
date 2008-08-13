<?php

/**
 * Basket components.
 *
 * @package    sfShop
 * @subpackage basket
 * @author     Dmitry Nesteruk
 */
class basketComponents extends sfComponents
{
   /**
    * Form for add product to shopping cart with quantity.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeAddToBasketForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        
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
}
