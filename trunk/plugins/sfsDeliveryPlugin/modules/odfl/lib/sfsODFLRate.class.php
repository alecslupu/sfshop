<?php

/**
 * 
 * @package    sfsShippingPlugin
 * @author     Andrey Kotlyarov
 */
class sfsODFLRate
{
    protected $_wsdl = 'https://www.odfl.com/RateWeb/services/RateEstimate/wsdl/RateEstimate.wsdl';
    protected $_soapClient    = null;
    protected $_calculateRate = null;
    
    
    
    public function __construct()
    {
        $this->_soapClient = new SoapClient($this->_wsdl);
    }
    
    
    
    public function call_calculateRate($params = array(), $defaultValue = null)
    {
        $args = array();
        $args['parameters'] = array();
        
        $args['parameters']['oZip'] = (isset($params['oZip']) ? $params['oZip'] : $defaultValue);
        $args['parameters']['oCity'] = (isset($params['oCity']) ? $params['oCity'] : $defaultValue);
        $args['parameters']['oState'] = (isset($params['oState']) ? $params['oState'] : $defaultValue);
        $args['parameters']['oCountry'] = (isset($params['oCountry']) ? $params['oCountry'] : $defaultValue);
        $args['parameters']['dZip'] = (isset($params['dZip']) ? $params['dZip'] : $defaultValue);
        $args['parameters']['dCity'] = (isset($params['dCity']) ? $params['dCity'] : $defaultValue);
        $args['parameters']['dState'] = (isset($params['dState']) ? $params['dState'] : $defaultValue);
        $args['parameters']['dCountry'] = (isset($params['dCountry']) ? $params['dCountry'] : $defaultValue);
        $args['parameters']['inboundOutbound'] = (isset($params['inboundOutbound']) ? $params['inboundOutbound'] : $defaultValue);
        $args['parameters']['discountRate'] = (isset($params['discountRate']) ? $params['discountRate'] : $defaultValue);
        $args['parameters']['user'] = (isset($params['user']) ? $params['user'] : $defaultValue);
        $args['parameters']['pWord'] = (isset($params['pWord']) ? $params['pWord'] : $defaultValue);
        $args['parameters']['account'] = (isset($params['account']) ? $params['account'] : $defaultValue);
        $args['parameters']['weights'] = (isset($params['weights']) ? $params['weights'] : $defaultValue);
        $args['parameters']['classes'] = (isset($params['classes']) ? $params['classes'] : $defaultValue);
        $args['parameters']['accessorials'] = (isset($params['accessorials']) ? $params['accessorials'] : $defaultValue);
        $args['parameters']['intTerminal'] = (isset($params['intTerminal']) ? $params['intTerminal'] : $defaultValue);
        $args['parameters']['cube'] = (isset($params['cube']) ? $params['cube'] : $defaultValue);
        $args['parameters']['currency'] = (isset($params['currency']) ? $params['currency'] : $defaultValue);
        $args['parameters']['refNumber'] = (isset($params['refNumber']) ? $params['refNumber'] : $defaultValue);
        
        $this->_calculateRate = $this->_soapClient->__call('calculateRate', $args);
    }
    
    
    
   /**
    * calculateRate by key and subkey
    *
    * $key and $subkey in list:
    * -------------------------------------------------------------------------
    * shippingDays
    * destinationServiceCenter -> serviceCenterCountry
    * destinationServiceCenter -> serviceCenterFax
    * destinationServiceCenter -> serviceCenterFax
    * destinationServiceCenter -> serviceCenterName
    * destinationServiceCenter -> serviceCenterPhone
    * destinationServiceCenter -> serviceCenterAlphaCode
    * destinationServiceCenter -> serviceCenterAddress
    * destinationServiceCenter -> serviceCenterCityStateZip
    * originatingServiceCenter -> serviceCenterCountry
    * originatingServiceCenter -> serviceCenterFax
    * originatingServiceCenter -> serviceCenterFax
    * originatingServiceCenter -> serviceCenterName
    * originatingServiceCenter -> serviceCenterPhone
    * originatingServiceCenter -> serviceCenterAlphaCode
    * originatingServiceCenter -> serviceCenterAddress
    * originatingServiceCenter -> serviceCenterCityStateZip
    * totalCharge
    * discountPercentage
    * discountDollarAmount
    * discountFreightCharge
    * fuelSurcharge
    * internationalCharge
    * totalNetCharge
    * guaranteedCharge
    * totalAccessorialCharge
    * destinationInterlineCarrier
    * destinationInterlineScac
    * originatingInterlineCarrier
    * originatingInterlineScac
    * errorCode
    * errorMessage
    * exchangeRate
    * originCities
    * convertedGuaranteed
    * convertedTotal
    * destinationCities
    * validationErrorCodes
    * validationError
    * processingError
    * currency
    * referenceNumber
    * variableAccessorialRate
    * backendFailure
    * -------------------------------------------------------------------------
    */
    public function calculateRate($key = null, $subkey = null)
    {
        $data = null;
        
        if ($key === null) {
            $data = $this->_calculateRate;
        } else {
            if ($subkey === null) {
                if (isset($this->_calculateRate->calculateRateReturn->{$key})) {
                    $data = $this->_calculateRate->calculateRateReturn->{$key};
                }
            } else {
                if (isset($this->_calculateRate->calculateRateReturn->{$key}->{$subkey})) {
                    $data = $this->_calculateRate->calculateRateReturn->{$key}->{$subkey};
                }
            }
        }
        
        return $data;
    }
    
    
    
    public function getErrorMessage($code)
    {
        $errors = array(
        // Processing Error Codes
            '001' => 'Customer not found',
            '002' => 'Customer not auto rated',
            '003' => 'Customer not auto rated',
            '004' => 'Customer not auto rated',
            '005' => 'Rateware error. Rate not found for specific zips. Total exceeds 99,999.99',
            '008' => 'Origin steamship rate invalid. Destination steamship rate invalid',
            '009' => 'Error writing Rate Estimate Record',
            '010' => 'Rates are invalid',
            '011' => 'Error on FCE conversion',
        
        // Origination
            '100' => 'No zip/postal code',
            '101' => 'Zip/postal code in invalid format',
            '102' => 'No city given',
            '103' => 'No state/province (see documentation for acceptable values)',
            '104' => 'State/province invalid',
            '105' => 'Origination country not given',
            '106' => 'Origination country incorrect',
            '107' => 'Not a valid zip code in Old Dominion files',
            '121' => 'Multiple cities found for this zip/postal code, check the destination cities array values',
        
        // Destination
            '200' => 'No zip/postal code',
            '201' => 'Zip/postal code in invalid format',
            '202' => 'No city given',
            '203' => 'No state/province',
            '204' => 'State/province invalid',
            '205' => 'Destination country not given',
            '206' => 'Destination country incorrect',
            '207' => 'Not a valid zip code in Old Dominion files',
            '221' => 'Multiple cities found for this zip/postal code, check the destination cities array values',
        
        // Authentication
            '300' => 'Invalid username/password combination',
            '301' => 'Account given doesn\'t have rights to secured rate estimate feature, call 1-800-235-5569',
            '302' => 'User name given doesn\'t have rights to secured rate estimate feature, call 1-800-235-5569',
            '304' => 'User name is empty or null, must be "none" or alpha-numeric string',
            '305' => 'Password is empty or null, must be "none" or alpha-numeric string',
            '306' => 'Account is empty or null, must be "none" or numeric string',
        
        // Miscellaneous
            '400' => 'Destination and origination countries cannot both be Canada',
            '401' => 'Destination and origination countries cannot both be Mexico',
            '402' => 'Inbound/outbound parameter cannot be empty',
            '403' => 'Inbound/outbound parameter must be either \'I\' or \'O\'',
            '404' => 'Length of accessorials array must be 6',
            '405' => 'Values in accessorials array must be either \'Y\' or \'N\'',
            '406' => 'Length of weights array must be 5',
            '407' => 'Values in weights array must be numeric string',
            '408' => 'Maximum weight per line item is 15000 lbs',
            '409' => 'Maximum weight per rate request is 40000 lbs',
            '410' => 'Length of classes array must be 5',
            '411' => 'Values of weights array must be numeric string',
            '412' => 'Invalid class value, see docs for valid values',
            '413' => 'There is an unmatched weight/class combination',
            '414' => 'All values in weights array and class array are zero',
            '415' => 'Discount value empty, must be zero or in this form .7950',
            '416' => 'Discount in wrong format, see error code 415',
            '417' => 'Weights array is empty or null, or has an empty or null element, must have length of 5 and have numeric string values',
            '418' => 'Classes array is empty or null, or has an empty or null element, must have length of 5 and have numeric string values',
            '419' => 'Accessorials array is empty or null, see error codes 404 and 405',
            '420' => 'International terminal parameter is empty or null, must be "none" if shipment is not to or from Mexico, or "TUS" or "LRD" if shipment is to or from Mexico',
            '421' => 'Cube is empty or null, must be "0" or numeric string value with maximum length of 4',
            '422' => 'Cube value is invalid, must be numeric string value with maximum length of 4',
            '423' => 'Currency is empty or null, only current acceptable value is "USD"',
            '424' => 'Currency value is invalid, only current acceptable value is "USD"',
            '425' => 'Reference number is empty or null, must be \'Y\' or \'N\'',
            '426' => 'Reference number value is invalid, must be \'Y\' or \'N\'',
            '427' => 'When Origin or Destination country is Mexico international terminal parameter must be "TUS" or "LRD"',
        
        // Processing Error Codes
            '900' => 'No service form this origin/destination zip code pair',
            '999' => 'Origin terminal not found. Destination terminal not found. Origin Steamship Interchange terminal not found. Destination Steamship Terminal not found'
        );
        
        if (isset($errors[$code])) {
            $error = $errors[$code];
        } else {
            $error = 'Code not found';
        }
        
        return $error;
    }
}