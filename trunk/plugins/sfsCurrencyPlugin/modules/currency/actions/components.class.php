<?php

/**
 * Currency components.
 *
 * @package    sfShop
 * @subpackage addressBook
 * @author     Dmitry Nesteruk
 */
class currencyComponents extends sfComponents
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
    }
}
