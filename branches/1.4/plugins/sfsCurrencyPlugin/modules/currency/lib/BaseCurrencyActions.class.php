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
 * Base currency actions.
 *
 * @package    plugin.sfsCurrencyPlugin
 * @subpackage modules.currency
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseCurrencyActions extends sfActions
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
                $currency = $request->getParameter('currency');
                $basket->setCurrencyId($currency['id']);
                $basket->save();
            }
        }
        
        $this->redirect($request->getReferer());
    }
}
