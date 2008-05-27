<?php

/**
 * sfsAddressBook form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage form
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsAddressBookForm extends BasesfsAddressBookForm
{
    public function configure()
    {
        $countries = sfsCountryPeer::getByCulture(sfContext::getInstance()->getUser()->getCulture());
        $arrayCountries = array();
        
        foreach ($countries as $country) {
            if (method_exists($country, 'getName')) {
                $arrayCountries[$country->getId()] = $country->getName();
            }
            else {
                $arrayCountries[$country->getId()] = $country->getNameEnglish();
            }
        }
        
        $arrayGenders = sfsMemberPeer::getGenders();
        
        $this->setWidgets(
            array(
                'gender'      => new sfWidgetFormSelect(array('choices' => $arrayGenders)),
                'first_name'  => new sfWidgetFormInput(),
                'last_name'   => new sfWidgetFormInput(),
                'country_id'  => new sfWidgetFormSelect(array('choices' => $arrayCountries)),
                'state'       => new sfWidgetFormInput(),
                'city'        => new sfWidgetFormInput(),
                'street'      => new sfWidgetFormInput(),
                'company'     => new sfWidgetFormInput(),
                'postcode'    => new sfWidgetFormInput(),
                'is_default'  => new sfWidgetFormInputCheckbox()
             )
        );
        
        $this->widgetSchema->setLabel('country_id', 'Country');
        
        $validatorGender = new sfValidatorChoice(
            array('choices' => $arrayGenders)
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 4
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 4
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
               'gender'      => $validatorGender,
               'first_name'  => $validatorFirstName,
               'last_name'   => $validatorLastName,
               'country_id'  => $validatorCountry,
               'state'       => $validatorState,
               'city'        => $validatorCity,
               'street'      => $validatorStreet,
               'postcode'    => $validatorPostcode
            )
        );
        
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->getWidgetSchema()->setNameFormat('address[%s]');
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
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
