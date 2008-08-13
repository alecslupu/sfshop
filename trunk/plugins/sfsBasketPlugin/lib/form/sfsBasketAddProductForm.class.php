<?php
class sfsBasketAddProductForm extends BasketForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetSet('product_id', new sfWidgetFormInputHidden());
        $this->getWidgetSchema()->offsetUnset('is_delete');
        
        /*
        $validatorProductId = new sfValidatorInteger(
            array(
                'required' => true,
            ),
            array(
                'invalid' => 'You have incorrect product id'
            )
        );
        */
        //$this->getValidatorSchema()->offsetSet('product_id', $validatorProductId);
        $this->setDefault('quantity', 1);
        $this->getWidgetSchema()->setNameFormat('add_product[%s]');
    }
}