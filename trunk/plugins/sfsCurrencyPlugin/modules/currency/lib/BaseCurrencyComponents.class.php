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
 * Base currency components.
 *
 * @package    plugin.sfsCurrencyPlugin
 * @subpackage modules.currency
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseCurrencyComponents extends sfComponents
{
   /**
    * Form for select currency.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeSelectCurrencyForm()
    {
        $this->getUser()->getBasket()->getCurrencyId();
        $this->form = new sfsSelectCurrencyForm();
        $this->form->setDefault('id', $this->getUser()->getBasket()->getCurrencyId());

        // hide component, where there's nothing to select from
        if (count($this->form->getArrayCurrencies()) <= 1) {
            return sfView::NONE;
        }
    }
}
