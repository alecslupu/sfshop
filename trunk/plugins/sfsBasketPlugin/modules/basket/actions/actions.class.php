<?php

/**
 * Basket actions.
 *
 * @package    pugins.sfsBasketPlugin
 * @subpackage modules
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class basketActions extends sfActions
{
    /**
    * Basket list action with update form.
    * 
    * If member marked some product, action will delete this products from basket.
    * If member changed quntity for some products, action will recalculate sum price and total price.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeList()
    {
        if ($this->getUser()->getAttributeHolder()->hasNamespace('products/unavailability')) {
            $products = $this->getUser()->getAttributeHolder()->getAll('products/unavailability');
            
            if (isset($products['deleted'])) {
                $this->deletedProducts = ProductPeer::getByIdsWithI18n($products['deleted']);
            }
            
            if (isset($products['insufficiently'])) {
                $this->insufficientlyProducts = ProductPeer::getByIdsWithI18n($products['insufficiently']);
            }
            
            $this->getUser()->getAttributeHolder()->removeNamespace('products/unavailability');
        }
        
        if ($this->getUser()->getAttributeHolder()->hasNamespace('delivery/errors')) {
            $this->deliveryErrors = $this->getUser()->getAttributeHolder()->getAll('delivery/errors');
            
            $this->getUser()->getAttributeHolder()->removeNamespace('delivery/errors');
        }
        
        $this->basket = $this->getUser()->getBasket();
        
        $this->form = new sfForm();
        $this->form->getWidgetSchema()->setNameFormat('items[%s]');
        
        if ($this->basket->hasProducts()) {
            foreach ($this->basket->getBasketProductsJoinProduct() as $basketProduct) {
                $subForm = new BasketForm();
                $subForm->setDefault('quantity', $basketProduct->getQuantity());
                
                if ($this->getRequest()->isMethod('post')) {
                    $addedQuantity = BasketProductPeer::retrieveQuantityByProductId($basketProduct->getProductId());
                    $validatorQuantity = $subForm->getValidatorSchema()->offsetGet('quantity');
                    
                    $max = $basketProduct->getProduct()->getQuantity() - $addedQuantity + $basketProduct->getQuantity();
                    $validatorQuantity->setOption('max', $max);
                    
                    $validatorQuantity->setMessage(
                        'max', 
                        str_replace('%max%', $max, $validatorQuantity->getMessage('max'))
                    );
                }
                
                $this->form->embedForm('product_' . $basketProduct->getId(), $subForm);
            }
        }
        
        if ($this->getRequest()->isMethod('post')) {
            
            $items = $this->getRequestParameter('items');
            
            //removes product marked for delete
            if ($this->basket->hasProducts()) {
                $basketProducts = $this->basket->getBasketProducts();
                
                foreach ($basketProducts as $key => $basketProduct) {
                    
                    if (isset($items['product_' . $basketProduct->getId()])) {
                        
                        $item = $items['product_' . $basketProduct->getId()];
                        
                        if (isset($item['is_delete'])) {
                            $basketProduct->delete();
                            unset($basketProducts[$key]);
                        }
                    }
                }
            }
            
            $this->form->bind($items);
            
            if ($this->form->isValid()) {
                
                //recalculate quantity
                if ($this->basket->hasProducts()) {
                    foreach ($basketProducts as $basketProduct) {
                        if (isset($items['product_' . $basketProduct->getId()])) {
                            $item = $items['product_' . $basketProduct->getId()];
                            $basketProduct->setQuantity($item['quantity']);
                            $basketProduct->save();
                        }
                    }
                }
            }
        }
    }
    
    /**
    * Add product to basket.
    * 
    * If product already added to basket, action will sum old value of quntity and new value.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    
    public function executeAdd()
    {
        sfLoader::loadHelpers('Url');
        
        
        if ($this->getRequest()->isMethod('post')) {
            
            $productId = $this->getRequestParameter('add_product[product_id]');
            $criteria = new Criteria();
            ProductPeer::addPublicCriteria($criteria);
            $product = ProductPeer::retrieveById($productId, $criteria);
            
            if ($product === null) {
                return $this->renderText(sfsJSONPeer::createResponseSuccess(array('redirect_to' => $this->getRequest()->getReferer())));
            }
            else {
                $optionsRequested = $this->getRequestParameter('add_product[options]');
                $optionsList = null;
                
                if ($optionsRequested !== null) {
                    $optionsList = array_values($optionsRequested);
                    $optionsList = implode(',', $optionsList);
                }
                
                $basket = $this->getUser()->getBasket();
                $basketProduct = BasketProductPeer::retrieveByBasketIdAndProductId($basket->getId(), $product->getId(), $optionsList);
                
                if ($basketProduct == null) {
                    $basketProduct = new BasketProduct();
                }
                
                $this->form = new BasketForm();
                $this->form->setDefault('quantity', $product->getQuantity());
                $validatorQuantity = $this->form->getValidatorSchema()->offsetGet('quantity');
                $addedQuantity = BasketProductPeer::retrieveQuantityByProductId($product->getId());
                $max = $product->getQuantity() - $addedQuantity + $basketProduct->getQuantity();
                $validatorQuantity->setOption('max', $max);
                
                $validatorQuantity->setMessage(
                    'max',
                    str_replace('%max%', $max, $validatorQuantity->getMessage('max'))
                );
                
                if ($product->getHasOptions()) {
                    $subform = new sfsProductOptionsForm($product);
                    $this->form->embedForm('options', $subform);
                }
                
                $this->form->bind(
                    array(
                        'quantity' => $this->getRequestParameter('add_product[quantity]')
                    )
                );
                
                if ($this->form->isValid()) {
                    $quantity = $this->getRequestParameter('add_product[quantity]');
                    
                    $basketProduct->setProductId($product->getId());
                    $basketProduct->setBasketId($basket->getId());
                    $basketProduct->save();
                    
                    if ($product->getHasOptions() && $basketProduct->getOptionsList() == '') {
                        foreach ($optionsRequested as $option) {
                            $basketProduct2OptionProduct = new BasketProduct2OptionProduct();
                            $basketProduct2OptionProduct->setBasketProductId($basketProduct->getId());
                            $basketProduct2OptionProduct->setOptionProductId($option);
                            $basketProduct2OptionProduct->save();
                        }
                    }
                    
                    $basketProduct->setQuantity($basketProduct->getQuantity() + $quantity);
                    $basketProduct->setOptionsList($optionsList);
                    $basketProduct->save();
                    
                    if ($this->getRequest()->isXmlHttpRequest()) {
                        return $this->renderText(sfsJSONPeer::createResponseSuccess(array('redirect_to' => url_for('@basket_list'))));
                    }
                    else {
                        $this->redirect('@basket_list');
                    }
                }
                else {
                    
                    if ($this->getRequest()->isXmlHttpRequest()) {
                        $errors = array();
                        
                        foreach ($this->form->getErrorSchema() as $field => $error) {
                            $errors[$field] = $error->getMessage();
                        }
                        
                        $this->renderText(sfsJSONPeer::createResponseError($errors));
                    }
                }
            }
        }
        
        return sfView::NONE;
    }
    
    /**
    * Remove product from basket.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $basket = $this->getUser()->getBasket();
            $basketProduct = BasketProductPeer::retrieveByPk($this->getRequestParameter('id'));
            
            if ($basketProduct !== null) {
                $basketProduct->delete();
            }
        }
        
        $this->redirect('@basket_list');
    }
}
