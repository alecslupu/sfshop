<?php

/**
 * sfsAddressBook form.
 *
 * @package    form
 * @subpackage address_book
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsAddressBookForm extends BasesfsAddressBookForm
{
    public function configure()
    {
        $c = new sfCultureInfo(sfContext::getInstance()->getUser()->getCulture());
        $arrayCountries = $c->getCountries();
        
        $this->setWidgets(
            array(
                'country_cid'        => new sfWidgetFormSelect(array('choices' => $arrayCountries)),
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
               //'country_cid' => $validatorCountry,
               'state'       => $validatorState,
               'city'        => $validatorCity,
               'street'      => $validatorStreet,
               'postcode'    => $validatorPostcode
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
    
    /**
    * Binds the form with input values.
    *
    * It triggers the validator schema validation.
    *
    * @param array An array of input values
    * @param array An array of uploaded files (in the $_FILES or $_GET format)
    * @author Dmitry Nesteruk
    * @access public
    */
    
    public function bind(array $taintedValues = null, array $taintedFiles = array())
    {
        $request = sfContext::getInstance()->getRequest();
        
        if ($request->hasParameter(self::$CSRFFieldName))
        {
            $taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
