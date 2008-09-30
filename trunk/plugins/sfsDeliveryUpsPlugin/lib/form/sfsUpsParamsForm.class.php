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
 * Form for edit parameters for Ups service.
 *
 * @package    plugin.sfsDeliveryUpsPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsUpsParamsForm extends DeliveryForm
{
    public function configure()
    {
        $arrayPickupMethods = array(
            ''    => '[select method]',
            'cc'  => 'Customer counter',
            'rdp' => 'Daily pickup', 
            'otp' => 'One time pickup', 
            'lc'  => 'Letter center', 
            'oca' => 'On call air'
        );
        
        $arrayPackages = array(
            ''    => '[select package]',
            'cp'  => 'Your packaging',
            'ule' => 'UPS Letter', 
            'ut'  => 'UPS Tube', 
            'ube' => 'UPS Express Box'
        );
        
        $arrayResidentials = array(
            ''    => '[select residential]',
            'res' => 'Quote for Residential',
            'com' => 'Commercial Delivery'
        );
        
        $arrayMethods = array(
            '1DM'    => 'Next Day Early AM Air',
            '1DML'   => 'Next Day Air Early AM Letter',
            '1DA'    => 'Next Day Air',
            '1DAL'   => 'Next Day Air Letter',
            '1DAPI'  => 'Next Day Air Intra (Puerto Rico)',
            '1DP'    => 'Next Day Air Saver',
            '1DPL'   => 'Next Day Air Saver Letter',
            '2DM'    => '2nd Day Early AM Air',
            '2DML'   => '2nd Day Air Early AM Letter',
            '2DA'    => '2nd Day Air',
            '2DAL'   => '2nd Day Air Letter',
            '3DS'    => '3 Day Select',
            'GND'    => 'Ground',
            'STD'    => 'UPS Standard',
            'XPR'    => 'Worldwide Express',
            'XPRL'   => 'Worldwide Express Letter',
            'XDM'    => 'Worldwide Express Plus',
            'XDML'   => 'Worldwide Express Plus Letter',
            'XPD'    => 'Worldwide Expedited'
        );
        
        $this->setWidgets(
            array(
                'pickup_method'  => new sfWidgetFormSelect(array('choices' => $arrayPickupMethods)),
                'package'        => new sfWidgetFormSelect(array('choices' => $arrayPackages)),
                'residential'    => new sfWidgetFormSelect(array('choices' => $arrayResidentials)),
                'handling'       => new sfWidgetFormInput(),
                'methods'        => new sfWidgetFormSelectMany(array('choices' => $arrayMethods)),
             )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'handling' => 'Handling fee for this shipping method',
                'methods'  => 'Select the USPS services to be offered'
            )
        );
        
        $validatorPickupMethod = new sfValidatorChoice(
            array('choices' => array_keys($arrayPickupMethods)),
            array('required' => 'You should select pickup method')
        );
        
        $validatorPackage = new sfValidatorChoice(
            array('choices' => array_keys($arrayPackages)),
            array('required' => 'You should select package')
        );
        
        $validatorResidential = new sfValidatorChoice(
            array('choices' => array_keys($arrayResidentials)),
            array('required' => 'You should select residential')
        );
        
        $validatorHandling = new sfValidatorNumber(
            array('required' => false),
            array('invalid'  => 'Handling must contain only numerals')
        );
        
        $validatorMethods = new sfValidatorChoiceMany(
            array('choices' => array_keys($arrayMethods)),
            array('required' => 'You should select methods')
        );
        
        $this->setValidators(
            array(
                'pickup_method' => $validatorPickupMethod,
                'package'       => $validatorPackage,
                'residential'   => $validatorResidential,
                'handling'      => $validatorHandling,
                'methods'       => $validatorMethods
             )
        );
        
        $this->defineSfsAdminListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
