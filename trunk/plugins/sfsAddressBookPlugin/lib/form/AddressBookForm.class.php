<?php

/**
 * AddressBook form.
 *
 * @package    plugin.sfsAddressBookPlugin
 * @subpackage form
 * @author     Dmitry Nesteruk
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
        $arrayCountriesWidget[] = '[select country]';
        
        foreach ($arrayCountries as $key => $title) {
            $arrayCountriesWidget[$key] = $title;
        }
        
        $arrayGenders = MemberPeer::getGenders();
        
        $this->setWidgets(
            array(
                'gender'             => new sfWidgetFormSelect(array('choices' => $arrayGenders)),
                'first_name'         => new sfWidgetFormInput(),
                'last_name'          => new sfWidgetFormInput(),
                'country_id'         => new sfWidgetFormSelect(array('choices' => $arrayCountriesWidget), array('onchange' => 'return selCountry_onChange(this.value);')),
                'state_id'           => new sfWidgetFormSelect(array('choices' => array('' => '[select state]'))),
                'state_title'        => new sfWidgetFormInput(),
                'city'               => new sfWidgetFormInput(),
                'street'             => new sfWidgetFormInput(),
                'company'            => new sfWidgetFormInput(),
                'postcode'           => new sfWidgetFormInput(),
                'is_default'         => new sfWidgetFormInputCheckbox(),
                'country_has_states' => new sfWidgetFormInputHidden()
             )
        );
        
        $this->widgetSchema->setLabel('country_id', 'Country');
        $this->widgetSchema->setLabel('state_id', 'State');
        $this->widgetSchema->setLabel('state_title', 'State');
        
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
        
        $criteria = new Criteria();
        StatePeer::addPublicCriteria($criteria);
        
        $validatorStateId = new sfValidatorChoice(
            array('choices' => StatePeer::getHash($criteria))
        );
        
        $validatorStateTitle = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
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
               'state_id'    => $validatorStateId,
               'state_title' => $validatorStateTitle,
               'city'        => $validatorCity,
               'street'      => $validatorStreet,
               'postcode'    => $validatorPostcode
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('address[%s]');
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
    
    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        if (!empty($taintedValues['state_id'])) {
            unset($taintedValues['state_title']);
            //$this->getWidgetSchema()->offsetUnset('state_title');
            $this->getValidatorSchema()->offsetUnset('state_title');
        }
        else if (!empty($taintedValues['state_title']) && !$taintedValues['country_has_states']) {
            unset($taintedValues['state_id']);
            //$this->getWidgetSchema()->offsetUnset('state_id');
            $this->getValidatorSchema()->offsetUnset('state_id');
        }
        
        parent::bind($taintedValues, $taintedFiles);
    }
}
