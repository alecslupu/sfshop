<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * AddressBook form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class AddressBookForm extends BaseAddressBookForm
{
    public function configure()
    {
        $criteria = new Criteria();
        CountryPeer::addPublicCriteria($criteria);
        $arrayCountries = CountryPeer::getHash($criteria);
        
        $arrayCountriesWidget = array();
        $arrayCountriesWidget[] = '';
        
        foreach ($arrayCountries as $key => $title) {
            $arrayCountriesWidget[$key] = $title;
        }
        
        $this->setWidgets(
            array(
                'first_name'         => new sfWidgetFormInput(),
                'last_name'          => new sfWidgetFormInput(),
                'country_id'         => new sfWidgetFormSelect(array('choices' => $arrayCountriesWidget)),
                'state_id'           => new sfWidgetFormSelect(array('choices' => array())),
                'state_title'        => new sfWidgetFormInput(),
                'city'               => new sfWidgetFormInput(),
                'street'             => new sfWidgetFormInput(),
                'company'            => new sfWidgetFormInput(),
                'postcode'           => new sfWidgetFormInput(),
                'is_default'         => new sfWidgetFormInputCheckbox(),
                'country_has_states' => new sfWidgetFormInputHidden()
             )
        );
        
        $this->widgetSchema->setLabels(
            array(
                'country_id'  => 'Country',
                'state_id'    => 'State',
                'state_title' => 'State'
            )
        );
        
        $validatorFirstName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 255
            ),
            array(
                'required'   => 'First Name is a required field',
                'min_length' => 'First Name can not be less 2 characters',
                'max_length' => 'First Name can not be more 255 characters',
            )
        );
        
        $validatorLastName = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 255
            ),
            array(
                'required'   => 'Last Name is a required field',
                'min_length' => 'Last Name can not be less 2 characters',
                'max_length' => 'Last Name can not be more 255 characters',
            )
        );
        
        $validatorCountry = new sfValidatorChoice(
            array('choices' => array_keys($arrayCountries)),
            array('invalid' => 'Please select a country')
        );
        
        $criteria = new Criteria();
        StatePeer::addPublicCriteria($criteria);
        
        $validatorStateId = new sfValidatorChoice(
            array('choices' => array_keys(StatePeer::getHash($criteria))),
            array(
                'required' => 'Please select a state',
                'invalid'  => 'Please select a state'
            )
        );
        
        $validatorStateTitle = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
            ),
            array(
                'required'   => 'State is a required field',
                'min_length' => 'State can not be less than 3 characters'
            )
        );
        
        $validatorCity = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
            ),
            array(
                'required'   => 'City is a required field',
                'min_length' => 'City can not be less than 3 characters'
            )
        );
        
        $validatorStreet = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
            ),
            array(
                'required'   => 'Street is a required field',
                'min_length' => 'Street can not be less than 3 characters'
            )
        );
        
        $validatorPostcode = new sfValidatorString(
            array('required' => true),
            array('required' => 'Postcode is a required field')
        );
        
        $this->setValidators(
            array(
               'first_name'  => $validatorFirstName,
               'last_name'   => $validatorLastName,
               'country_id'  => $validatorCountry,
               'state_id'    => $validatorStateId,
               'state_title' => $validatorStateTitle,
               'city'        => $validatorCity,
               'street'      => $validatorStreet,
               'postcode'    => $validatorPostcode
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
    
    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        if (isset($taintedValues['country_has_states']) && $taintedValues['country_has_states'] == 1) {
            unset($taintedValues['state_title']);
            $this->getValidatorSchema()->offsetUnset('state_title');
        }
        else if(isset($taintedValues['country_has_states'])) {
            unset($taintedValues['state_id']);
            $this->getValidatorSchema()->offsetUnset('state_id');
        }
        
        parent::bind($taintedValues, $taintedFiles);
    }
}
