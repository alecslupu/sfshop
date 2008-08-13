<?php

/**
 * currency actions.
 *
 * @package    sfShop
 * @subpackage currency
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class currencyActions extends sfActions
{
   /**
    * Sets selected currency action.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeSetSelected($request)
    {
        if ($this->getRequest()->isMethod('post')) {
            
            $form = new sfsSelectCurrencyForm();
            
            $form->bind($this->getRequestParameter('currency'));
            
            if ($form->isValid()) {
                $basket = $this->getUser()->getBasket();
                $basket->setCurrencyId($request->getParameter('currency[id]'));
                $basket->save();
            }
        }
        
        $this->redirect($request->getReferer());
    }
}
