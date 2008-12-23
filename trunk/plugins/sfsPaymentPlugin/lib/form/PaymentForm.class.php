<?php

/**
 * Payment form.
 *
 * @package    form
 * @subpackage payment
 * @version    SVN: $Id$
 */
class PaymentForm extends BasePaymentForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'id'           => new sfWidgetFormInputHidden(),
                'title'        => new sfWidgetFormInput(),
                'description'  => new sfWidgetFormTextarea(),
                'is_active'    => new sfWidgetFormInputCheckbox()
             )
        );
        
        $validatorTitle = new sfValidatorString(
            array(
                'required'   => true, 
                'min_length' => 1, 
                'max_length' => 100
            ),
            array(
                'required'   => 'You must input title',
                'min_length' => 'Title must be 1 or more characters',
                'max_length' => 'Title must be 100 or less characters'
            )
        );
        
        $validatorDescription = new sfValidatorString(
            array(
                'required'   => false, 
                'min_length' => 5,
                'max_length' => 200
            ),
            array(
                'min_length' => 'Title must be 5 or more characters',
                'max_length' => 'Title must be 200 or less characters'
            )
        );
        
        $this->setValidators(
            array(
                'title'       => $validatorTitle,
                'description' => $validatorDescription
            )
        );
        
        $this->defineSfsAdminListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
        $this->getWidgetSchema()->setNameFormat('data[%s]');
    }
}
