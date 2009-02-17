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
 * Base basket actions.
 *
 * @package    pugins.sfsBasketPlugin
 * @subpackage modules.basket
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseBasketActions extends sfActions
{
   /**
    * Basket list action with update form.
    * 
    * If member marked some product and submit form, action will delete this products from basket.
    * If member changed quantity of products, action will recalculate sum price and total price.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeList($request)
    {
        $sfUser = $this->getUser();
        
        if ($sfUser->getAttributeHolder()->hasNamespace('products/unavailability')) {
            $products = $sfUser->getAttributeHolder()->getAll('products/unavailability');
            
            if (isset($products['deleted'])) {
                $this->deletedProducts = ProductPeer::getByIds($products['deleted'], null, true);
            }
            
            if (isset($products['insufficiently'])) {
                $this->insufficientlyProducts = ProductPeer::getByIds($products['insufficiently'], null, true);
            }
            
            $sfUser->getAttributeHolder()->removeNamespace('products/unavailability');
        }
        
        $this->basket = $sfUser->getBasket();
        
        $this->form = new sfForm();
        $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
        $this->form->getWidgetSchema()->setNameFormat('items[%s]');
        
        if ($this->basket->hasProducts()) {
            foreach ($this->basket->getBasketProductsJoinProduct() as $basketProduct) {
                $subForm = new BasketForm();
                $subForm->setDefault('quantity', $basketProduct->getQuantity());
                
                if ($this->getRequest()->isMethod('post')) {
                    $validatorQuantity = $subForm->getValidatorSchema()->offsetGet('quantity');
                    if($basketProduct->getProduct()->getAllowOutOfStock()) {
                       $validatorQuantity->setOption('max', NULL);
                    }
                    else {
                      $max = $basketProduct->getProduct()->getQuantity();
                      $validatorQuantity->setOption('max', $max);
                    
                      $validatorQuantity->setMessage(
                          'max', 
                          str_replace('%max%', $max, $validatorQuantity->getMessage('max'))
                      );
                    }
                }
                
                $this->form->embedForm('product_' . $basketProduct->getId(), $subForm);
            }
        }
        
        $arrayDeletedProducts = array();
        
        if ($this->getRequest()->isMethod('post')) {
            
            $items = $this->getRequestParameter('items');
            
            //removes product marked for delete
            if ($this->basket->hasProducts()) {
                $basketProducts = $this->basket->getBasketProducts();
                
                foreach ($basketProducts as $key => $basketProduct) {
                    
                    if (isset($items['product_' . $basketProduct->getId()])) {
                        
                        $item = $items['product_' . $basketProduct->getId()];
                        
                        if (isset($item['is_delete'])) {
                            $arrayDeletedProducts[] = $basketProduct->getId();
                            $basketProduct->delete();
                            unset($basketProducts[$key]);
                            $this->form->offsetUnset('product_' . $basketProduct->getId());
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
            else {
                $errors = array();
                
                foreach ($this->form->getErrorSchema() as $field => $error) {
                    if (strpos($error->getMessage(), '[')) {
                        list($subField, $message) = explode('[', $error->getMessage());
                        $message = str_replace('[', '', $message);
                        $message = str_replace(']', '', $message);
                        $errors[$field] = array(str_replace(' ', '', $subField) => $message);
                    }
                    else {
                        $errors[$field] = $error->getMessage();
                    }
                }
            }
        }
        
        if ($request->isXmlHttpRequest()) {
            
            sfLoader::loadHelpers(array('sfsCurrency'));
            
            if (isset($errors)) {
                return $this->renderText(sfsJSONPeer::createResponseError($errors));
            }
            else {
                 
                 if ($this->basket->hasProducts()) {
                    
                    $products = array();
                    
                    foreach ($basketProducts as $basketProduct) {
                        $products[] = array(
                            'id'           => $basketProduct->getId(),
                            'price'        => format_currency($basketProduct->getProductPrice()),
                            'total_price'  => format_currency($basketProduct->getTotalPrice())
                        );
                    }
                }
                
                $response = array(
                    'products'         => isset($products) ? $products : array(),
                    'total_price'      => format_currency($this->basket->getTotalPrice()),
                    'deleted_products' => $arrayDeletedProducts
                );
                
                return $this->renderText(sfsJSONPeer::createResponseSuccess($response));
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    
    public function executeAdd($request)
    {
        sfLoader::loadHelpers('Url');
        $sfUser = $this->getUser();
        
        if ($request->isMethod('post')) {
            
            $productId = $request->getParameter('add_product[product_id]');
            $criteria = new Criteria();
            ProductPeer::addPublicCriteria($criteria);
            $product = ProductPeer::retrieveById($productId, $criteria);
            
            if ($product === null) {
                return $this->renderText(sfsJSONPeer::createResponseSuccess(array('redirect_to' => $request->getReferer())));
            }
            else {
                $optionsRequested = $request->getParameter('add_product[options]');
                $optionsList = null;
                
                if ($optionsRequested !== null) {
                    $optionsList = array_values($optionsRequested);
                    $optionsList = implode(',', $optionsList);
                }
                
                $basket = $sfUser->getBasket();
                $basketProduct = BasketProductPeer::retrieveByBasketIdAndProductId($basket->getId(), $product->getId(), $optionsList);
                
                if ($basketProduct == null) {
                    $basketProduct = new BasketProduct();
                }
                
                $this->form = new BasketForm();
                $this->form->setDefault('quantity', $product->getQuantity());
                $validatorQuantity = $this->form->getValidatorSchema()->offsetGet('quantity');
                
                if($product->getAllowOutOfStock()) {
                    $validatorQuantity->setOption('max', NULL);
                }
                else {
                    $max = $product->getQuantity() -  $basketProduct->getQuantity();
                    $validatorQuantity->setOption('max', $max);

                    $validatorQuantity->setMessage(
                        'max',
                        str_replace('%max%', $max, $validatorQuantity->getMessage('max'))
                    );
                }
                
                if ($product->getHasOptions()) {
                    $subform = new sfsProductOptionsForm($product);
                    $this->form->embedForm('options', $subform);
                }
                
                $this->form->bind(
                    array(
                        'quantity' => $request->getParameter('add_product[quantity]')
                    )
                );
                
                if ($this->form->isValid()) {
                    $quantity = $request->getParameter('add_product[quantity]');
                    
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
                    
                    if ($request->isXmlHttpRequest()) {
                        return $this->renderText(sfsJSONPeer::createResponseSuccess(array('quantity' => $basketProduct->getQuantity())));
                    }
                    else {
                        $this->redirect('@basket_list');
                    }
                }
                else {
                    
                    if ($request->isXmlHttpRequest()) {
                        $errors = array();
                        
                        foreach ($this->form->getErrorSchema() as $field => $error) {
                            $errors[$field] = $error->getMessage();
                        }
                        
                        return $this->renderText(sfsJSONPeer::createResponseError($errors));
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeDelete($request)
    {
        if ($request->hasParameter('id')) {
            $basket = $this->getUser()->getBasket();
            $basketProduct = BasketProductPeer::retrieveByPk($request->getParameter('id'));
            
            if ($basketProduct !== null && $basketProduct->getBasketId() == $basket->getId()) {
                $basketProduct->delete();
            }
        }
        
        if ($request->isXmlHttpRequest()) {
            return $this->renderText(
                sfsJSONPeer::createResponseSuccess(
                    array('has_products' => $basket->hasProducts())
                )
            );
        }
        else {
            $this->redirect('@basket_list');
        }
    }
}
