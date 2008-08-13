<?php

/**
 * Basket form.
 *
 * @package    form
 * @subpackage basket
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class BasketForm extends BaseBasketForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'quantity'   => new sfWidgetFormInput(array(), array('size' => '5')),
                'is_delete'  => new sfWidgetFormInputCheckbox()
             )
        );
        
        $validatorQuantity = new sfValidatorInteger(
            array(
                'required' => true,
                'min'      => 1,
                'max'      => 1
            ),
            array(
                'min' => 'Min product quantity is 1',
                'max' => 'This products does not exist in desired quantity in our stock (Max is %max%).'
            )
        );
        
        $this->setValidators(
            array(
               'quantity'   => $validatorQuantity
            )
        );
        
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
