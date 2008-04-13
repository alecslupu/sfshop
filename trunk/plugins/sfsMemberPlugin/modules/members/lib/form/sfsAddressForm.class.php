<?php
class sfsAddressForm extends sfsAddressBookForm
{
    public function configure()
    {
        $c = new sfCultureInfo(sfContext::getInstance()->getUser()->getCulture());
        $arrayCountries = $c->getCountries();
        
        $this->setWidgets(
            array(
                'country_id'         => new sfWidgetFormSelect(array('choices' => $arrayCountries)),
                'state'              => new sfWidgetFormInput(),
                'city'               => new sfWidgetFormInput(),
                'street'             => new sfWidgetFormInput(),
                'postcode'           => new sfWidgetFormInput()
             )
        );
        
        $validatorCountry = new sfValidatorChoice(
            array('choices' => $arrayCountries)
        );
        
        $validatorState = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3,
                'max_length' => 30
            ),
            array(
                'min_length' => 'State can not be less than 3 characters'
            )
        );
        
        $validatorCity = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
            ),
            array(
                'min_length' => 'City can not be less than 3 characters'
            )
        );
        
        $validatorStreet = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 5
            ),
            array(
                'min_length' => 'Street can not be less than 5 characters'
            )
        );
        
        $validatorPostcode = new sfValidatorString(
            array(
                'required'   => true
            )
        );
        
        $this->setValidators(
            array(
               //'country_id' => $validatorCountry,
               'state'      => $validatorState,
               'city'       => $validatorCity,
               'street'     => $validatorStreet,
               'postcode'   => $validatorPostcode
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
}