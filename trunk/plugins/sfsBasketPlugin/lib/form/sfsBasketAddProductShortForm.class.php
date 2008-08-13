<?php
class sfsBasketAddProductShortForm extends sfsBasketAddProductForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetUnset('quantity');
        $this->getWidgetSchema()->offsetSet('quantity', new sfWidgetFormInputHidden());
    }
}