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
 * Gets available methods for shipping via Federal express service and calculates shipping costs for each method.
 *
 * @package    plugins.sfDeliveryFedexPlugin
 * @subpackage lib
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfAction.class.php 9477 2008-06-09 09:41:14Z fabien $
 */
class sfsFedexService extends sfsBaseDeliveryService
{
    protected $domesticTypes = array(
         'PRIORITY_OVERNIGHT'   => 'Priority (by 10:30AM, later for rural)',
         'FEDEX_2_DAY'          => '2 Day Air',
         'STANDARD_OVERNIGHT'   => 'Standard overnight (by 3PM, later for rural)',
         'FIRST_OVERNIGHT'      => 'First overnight', 
         'FEDEX_EXPRESS_SAVER'  => 'Express saver (3 Day)',
         'GROUND_HOME_DELIVERY' => 'Ground home delivery',
         'FEDEX_GROUND'         => 'Ground service'
    );
    
    protected $internationalTypes = array(
         'INTERNATIONAL_PRIORITY' => 'International Priority (1-3 Days)',
         'INTERNATIONAL_ECONOMY'  => 'International Economy (4-5 Days)',
         'INTERNATIONAL_FIRST'    => 'International First',
         'GROUND_HOME_DELIVERY'   => 'Ground home delivery',
         'FEDEX_GROUND'           => 'Ground service'
    );
    
    public function setParamKey($value)
    {
        $this->params['key'] = $value;
    }
    
    public function getParamKey()
    {
        return $this->params['key'];
    }
    
    public function setParamPassword($value)
    {
        $this->params['password'] = $value;
    }
    
    public function getParamPassword()
    {
        return $this->params['password'];
    }
    
    public function setParamAccount($value)
    {
        $this->params['account'] = $value;
    }
    
    public function getParamAccount()
    {
        return $this->params['account'];
    }
    
    public function setParamWeightUnit($value)
    {
        $this->params['weight_unit'] = $value;
    }
    
    public function getParamWeightUnit()
    {
        return $this->params['weight_unit'];
    }
    
    public function setParamDimensionUnit($value)
    {
        $this->params['dimension_unit'] = $value;
    }
    
    public function getParamDimensionUnit()
    {
        return $this->params['dimension_unit'];
    }
    
    public function setParamDropoff($value)
    {
        $this->params['dropoff'] = $value;
    }
    
    public function getParamDropoff()
    {
        return $this->params['dropoff'];
    }
    
    public function setParamMeter($value)
    {
        $this->params['meter'] = $value;
    }
    
    public function getParamMeter()
    {
        return $this->params['meter'];
    }
    
    public function setParamInsure()
    {
        $this->params['insure'] = $value;
    }
    
    public function getParamInsure()
    {
        return $this->params['insure'];
    }
    
    public function setParamPackagingType($value)
    {
        $this->params['packaging_type'] = $value;
    }
    
    public function getParamPackagingType()
    {
        return $this->params['packaging_type'];
    }
    
    public function setParamResidential($value)
    {
        $this->params['residential'] = $value;
    }
    
    public function getParamResidential()
    {
        return $this->params['residential'];
    }
    
    public function getQuote()
    {
        sfLoader::loadHelpers(array('sfsCurrency'));
        ini_set("soap.wsdl_cache_enabled", "0"); 
        
        $wsdl = dirname(__FILE__). '/../data/fedex/RateService_v4.wsdl';
        $soapClient = new SoapClient($wsdl, array('trace' => 1));
        
        $request['WebAuthenticationDetail'] = array(
            'UserCredential' => array('Key' => $this->getParamKey(), 'Password' => $this->getParamPassword())
        );
        
        $request['ClientDetail'] = array(
            'AccountNumber' => $this->getParamAccount(),
            'MeterNumber'   => $this->getParamMeter()
        );
        
        $request['Version'] = array('ServiceId' => 'crs', 'Major' => '4', 'Intermediate' => '0', 'Minor' => '0');
        
        $request['RequestedShipment']['DropoffType'] = $this->getParamDropoff();
        
        $storeAddress = $this->getStoreAddress();
        
        $request['RequestedShipment']['Shipper'] = array('Address' => 
            array(
                'StreetLines'         => array($storeAddress['street']),
                'City'                => $storeAddress['city'],
                'StateOrProvinceCode' => $storeAddress['state_iso'],
                'PostalCode'          => $storeAddress['postcode'],
                'CountryCode'         => $storeAddress['country_iso']
            )
        );
        
        $deliveryAddress = $this->getDeliveryAddress();
        
        if ($this->getParamResidential() > 0) {
            $residential = true;
        }
        else {
            $residential = false;
        }
        
        $request['RequestedShipment']['Recipient'] = array('Address' =>
            array (
                'StreetLines'         => array($deliveryAddress['street']),
                'City'                => $deliveryAddress['city'],
                'StateOrProvinceCode' => $deliveryAddress['state_iso'],
                'PostalCode'          => $deliveryAddress['postcode'],
                'CountryCode'         => $deliveryAddress['country_iso'],
                'Residential'         => $residential
            )
        );
        
        $request['RequestedShipment']['ShippingChargesPayment'] = array(
            'PaymentType' => 'SENDER',
            'Payor' => array(
                'AccountNumber' => $this->getParamAccount(),
                'CountryCode'   => 'US'
            )
        );
        
        $request['RequestedShipment']['RateRequestTypes'] = 'LIST'; 
        $request['RequestedShipment']['PackageDetail'] = 'INDIVIDUAL_PACKAGES';
        
        $request['RequestedShipment']['TotalWeight'] = array(
            'Value' => $this->getTotalWeight(),
            'Units' => $this->getParamWeightUnit()
        );
        
        //will be used for other sfShop version
        //$request['RequestedShipment']['PackagingType'] = $this->getParamPackagingType();
        
        $request['RequestedShipment']['PackageCount'] = $this->getNumBoxes() + 1;
        
        $amount = $this->getTotalPrice() / $this->getNumBoxes();
        
        if ($amount > $this->getParamInsure() && $this->getParamInsure() != 0) {
            $request['RequestedShipment']['TotalInsuredValue'] = array(
                'Amount'   => sprintf("%01.2f", $amount),
                'Currency' => 'USD'
            );
        }
        
        $request['RequestedShipment']['RequestedPackages'] = array();
        
        $itemProducts = $this->getItemProducts();
        $i = 0;
        
        foreach ($itemProducts as $itemProduct) {
            
            $request['RequestedShipment']['RequestedPackages'][] = array(
                 'Weight' => array(
                      'Value' => $itemProduct->getTotalWeight(),
                      'Units' => $this->getParamWeightUnit()
                  )
                  /* will be used for other sfShop version
                 'Dimensions' => array(
                      'Length' => 25,
                      'Width'  => 10,
                      'Height' => 10,
                      'Units'  => $this->getParamDimensionUnit()
                 )*/
            );
            
            $i++;
        }
        
        $quotes = array();
        
        try {
            $response = $soapClient->getRates($request);
            
            $internetional = false;
            
            if ($storeAddress['country_iso'] != $deliveryAddress['country_iso']) {
                $internetional = true;
            }
            
            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                foreach ($response->RateReplyDetails as $rateReply) {
                    
                    $surcharge = 0;
                    
                    if ($internetional === false) {
                        $methodTitle = $this->domesticTypes[$rateReply->ServiceType];
                        
                        if (($storeAddress['country_iso'] == "US" && $rateReply->ServiceType == 'FEDEX_EXPRESS_SAVER') ||
                            ($storeAddress['country_iso'] == "CA" && $rateReply->ServiceType == 'FEDEX_GROUND')) {
                            $surcharge = $this->getParamResidential();
                        }
                    }
                    else {
                        $methodTitle = $this->internationalTypes[$rateReply->ServiceType];
                    }
                    
                    $amount = $rateReply->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetFedExCharge->Amount;
                    $price = $amount * $this->getNumBoxes() + $surcharge;
                    
                    $quotes[] = array(
                        'id'    => $rateReply->ServiceType,
                        'title' => $methodTitle,
                        'price' => $price
                    );
                } 
            }
            else {
                
                if (!is_array($response->Notifications)) {
                    $this->logMessage('Delivery (Fedex service): ' . $response->Notifications->Message);
                }
                else {
                    foreach ($response->Notifications as $notification) {
                        $this->logMessage('Delivery (Fedex service): ' . $notification->Severity . ' : ' . $notification->Message);
                    }
                }
            }
        }
        catch(SoapFault $exception) {
            $this->logMessage('Delivery (Fedex service): ' . $exception->faultstring, sfLogger::CRIT);
        }
        
        return $quotes;
    }
}