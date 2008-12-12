<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Form for edit parameters for Fedex service.
 *
 * @package    plugin.sfsDeliveryFedexPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsFedexParamsForm extends DeliveryForm
{
    public function configure()
    {
        $arrayWeightUnit = array(
            'KG' => 'kgs',
            'LB' => 'lbs'
        );
        
        $arrayDropoff = array(
            'REGULAR_PICKUP'          => 'Regular pickup',
            'REQUEST_COURIER'         => 'Request courier',
            'DROP_BOX'                => 'Drop box',
            'BUSINESS_SERVICE_CENTER' => 'Drop at BSC',
            'STATION'                 => 'Drop at station'
        );
        
        $arrayPackagingType = array(
            'YOUR_PACKAGING' => 'Your packaging',
            'FEDEX_BOK'      => 'Fedex bok',
            'FEDEX_PAK'      => 'Fedex pak',
            'FEDEX_TUBE'     => 'Fedex tube'
        );
        
        
        $arrayDimensionUnit = array(
            'IN' => 'IN',
            'CM' => 'CM'
        );
        
        $this->setWidgets(
            array(
                'key'            => new sfWidgetFormInput(),
                'password'       => new sfWidgetFormInput(),
                'account'        => new sfWidgetFormInput(),
                'meter'          => new sfWidgetFormInput(),
                'weight_unit'    => new sfWidgetFormSelect(array('choices' => $arrayWeightUnit)),
                //'dimension_unit' => new sfWidgetFormSelect(array('choices' => $arrayDimensionUnit)), //will be used for other sfShop version
                //'packaging_type' => new sfWidgetFormSelect(array('choices' => $arrayPackagingType)), //will be used for other sfShop version
                'residential'    => new sfWidgetFormInput(),
                'insure'         => new sfWidgetFormInput(),
                'dropoff'        => new sfWidgetFormSelect(array('choices' => $arrayDropoff)),
             )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'key'         => 'Unique identifier assigned to you as part of authetication credential',
                'password'    => 'Second part of the authetication credential',
                'account'     => 'Account Number assigned to you',
                'meter'       => 'MeterID assigned to you, leave blank to obtain a new meter number',
                'transit'     => 'Do you want to show transit times for ground or home delivery rates?',
                'server'      => 'You must have an account with Fedex',
                'residential' => 'Residential Surcharge (in addition to other surcharge) for Express packages within US, or ground packages within Canada?',
                'timeout'     => 'Enter the maximum time in seconds you would wait for a rate request from Fedex? Leave blank for default timeout.',
                'insure'      => 'Insure packages over what dollar amount?'
            )
        );
        
        $validatorKey = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'Enter the fedex key assigned to you'
            )
        );
        
        $validatorPassword = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'Enter the fedex password assigned to you'
            )
        );
        
        $validatorAccount = new sfValidatorNumber(
            array(
                'required' => true
            ),
            array(
                'required' => 'Enter the fedex Account Number assigned to you',
                'invalid'  => 'Account number must contain only numerals'
            )
        );
        
        $validatorMeter = new sfValidatorNumber(
            array(
                'required' => false
            ),
            array('invalid'  => 'Metter must contain only numerals')
        );
        
        $validatorWeightUnit = new sfValidatorChoice(
            array('choices' => array_keys($arrayWeightUnit))
        );
        
        $validatorDimensionUnit = new sfValidatorChoice(
            array('choices' => array_keys($arrayDimensionUnit))
        );
        
        $validatorPackagingType = new sfValidatorChoice(
            array('choices' => array_keys($arrayPackagingType))
        );
        
        $validatorResidential = new sfValidatorNumber(
            array(
                'required' => false
            ),
            array('invalid'  => 'Residential must contain only numerals')
        );
        
        $validatorInsure  = new sfValidatorNumber(
            array(
                'required' => false
            ),
            array('invalid'  => 'Insure must contain only numerals')
        );
        
        $validatorDropoff = new sfValidatorChoice(
            array('choices' => array_keys($arrayDropoff))
        );
        
        $this->setValidators(
            array(
                'key'            => $validatorKey,
                'password'       => $validatorPassword,
                'account'        => $validatorAccount,
                'meter'          => $validatorMeter,
                'weight_unit'    => $validatorWeightUnit,
                //'dimension_unit' => $validatorDimensionUnit, //will be used for other sfShop version
                //'packaging_type' => $validatorPackagingType,  //will be used for other sfShop version
                'residential'    => $validatorResidential,
                'insure'         => $validatorInsure,
                'dropoff'        => $validatorDropoff,
             )
        );
        
        $this->defineSfsAdminListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
