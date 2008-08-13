<?php

class sfsFedexService extends sfsBaseService {
    
    protected $params = array();
    protected $errors = array();
    protected $intl;
    
    protected $domesticTypes = array(
         '01' => 'Priority (by 10:30AM, later for rural)',
         '03' => '2 Day Air',
         '05' => 'Standard Overnight (by 3PM, later for rural)',
         '06' => 'First Overnight', 
         '20' => 'Express Saver (3 Day)',
         '90' => 'Home Delivery',
         '92' => 'Ground Service'
         );
    
    protected $internationalTypes = array(
         '01' => 'International Priority (1-3 Days)',
         '03' => 'International Economy (4-5 Days)',
         '06' => 'International First',
         '90' => 'Home Delivery',
         '92' => 'Ground Service'
         );
    
    public function getQuote($deliveryAddress, $weight, $cube, $numBoxes, $totalPrice, $params = array())
    {
        
        if ($this->params['envelop'] && 1!=1) {
            if ( ($weight <= .5 && $this->params['weight_unit'] == 'lbs') ||
                 ($weight <= .2 && $this->params['weight_unit'] == 'kgs')) {
                $packageType = '06';
            }
            else {
                $packageType ='01';
            }
        }
        else {
            $packageType = '01';
        }
        
        if ($packageType == '01' && $weight < 1) {
            $weight = sprintf("%01.1f", 1);
        }
        else {
            $weight = sprintf("%01.1f", $weight);
        }
        
        $amount = $totalPrice / $numBoxes;
        
        if ($amount > $this->params['insure']) {
            $this->params['insurance'] = sprintf("%01.2f", $amount);
        }
        else {
            $this->params['insurance'] = 0;
        }
        
        $fedexQuote = $this->getQuoteFromService($deliveryAddress, $weight, $packageType);
        
        if ($this->isErrorSet()) {
            return false;
        }
        
        if (is_array($fedexQuote)) {
            /*
            $this->quotes = array('id' => $this->code,
                                'module' => $this->title . ' (' . $shipping_num_boxes . ' x ' . $weight . strtolower(MODULE_SHIPPING_FEDEX1_WEIGHT) . ')');
            */
            
            $methods = array();
            
            foreach ($fedexQuote as $type => $cost) {
                $skip = false;
                $surcharge = 0;
                
                if ($this->intl === false) {
                    if (strlen($type) > 2 && $this->params['transit']) {
                        $serviceDescr = $this->domesticTypes[substr($type, 0, 2)] . ' (' . substr($type, 2, 1) . ' days)';
                    }
                    else {
                        $serviceDescr = $this->domesticTypes[substr($type, 0, 2)];
                    }
                    
                    switch (substr($type,0,2)) {
                        case 90:
                            if ($deliveryAddress['company'] != '') {
                                $skip = true;
                            }
                            break;
                        case 92:
                            if ($this->params['original_address']['country_iso'] == "CA") {
                                if ($deliveryAddress['company'] == '') {
                                    $surcharge = $this->params['residential'];
                                }
                            }
                            else {
                              if ($deliveryAddress['company'] == '') {
                                $skip = true;
                              }
                            }
                            break;
                        default:
                            if ($this->params['original_address']['country_iso'] != "CA" && substr($type, 0, 2) < "90" && $this->params['original_address']['country_iso'] == '') {
                                $surcharge = $this->params['residential'];
                            }
                            break;
                    }
                }
                else {
                    if (strlen($type) > 2 && $this->params['transit']) {
                        $serviceDescr = $this->internationalTypes[substr($type,0,2)] . ' (' . substr($type,2,1) . ' days)';
                    }
                    else {
                        $serviceDescr = $this->internationalTypes[substr($type,0,2)];
                    }
                }
                
                if (!$skip) {
                    $methods[] = array(
                        'id'    => substr($type, 0, 2),
                        'title' => $serviceDescr,
                        'price' => ($this->params['surcharge'] + $surcharge + $cost) * $numBoxes
                    );
                }
            }
            
            $this->quotes = $methods;
        }
        else {
            $this->setError('An error occured with the fedex shipping calculations.<br>Fedex may not deliver to your country, or your postal code may be wrong.');
        }
        
        return $this->quotes;
    }
    
    protected function executeRequest($data)
    {
        if ($this->params['server'] == 'production') {
            $server = 'gateway.fedex.com/GatewayDC';
        }
        else {
            $server = 'gatewaybeta.fedex.com/GatewayDC';
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://' . $server);
        
        if ($this->params['timeout'] != '') {
            curl_setopt($ch, CURLOPT_TIMEOUT, MODULE_SHIPPING_FEDEX1_TIMEOUT);
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Referer: ' . sfContext::getInstance()->getRequest()->getUriPrefix(),
            'Host: ' . $server,
            'Accept: image/gif,image/jpeg,image/pjpeg,text/plain,text/html,*/*',
            'Pragma:',
            'Content-Type:image/gif'
        ));
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
    }
    
    protected function getMeter()
    {
        $data = '0,"211"';
        $data .= '10,"' . $this->params['account'] . '"'; // Sender Fedex account number
        $data .= '4003,"' . sfConfig::get('app_store_owner_name') . '"'; // Subscriber contact name
        $data .= '4007,"' . sfConfig::get('app_store_company') . '"'; // Subscriber company name
        $data .= '4008,"' . $this->params['original_address']['address'] . '"'; // Subscriber Address line 1
        
        $data .= '4011,"' . $this->params['original_address']['city'] . '"'; // Subscriber City Name
        
        if ($this->params['original_address']['state_iso'] != '') {
            $data .= '4012,"' . $this->params['original_address']['state_iso'] . '"'; // Subscriber State code
        }
        
        $data .= '4013,"' . $this->params['original_address']['postcode'] . '"'; // Subscriber Postal Code
        $data .= '4014,"' . $this->params['original_address']['country_iso'] . '"'; // Subscriber Country Code
        $data .= '4015,"' . $this->params['original_address']['phone'] . '"'; // Subscriber phone number
        $data .= '99,""';
        
        $fedexData = $this->executeRequest($data);
        $meterStart = strpos($fedexData,'"498,"');
        
        if ($meterStart === false) {
            if (strlen($fedexData) == 0) {
                $this->setError('No response to CURL from Fedex server, check CURL availability, or maybe timeout was set too low, or maybe the Fedex site is down');
            }
            else {
                $fedexData = $this->parseResponse($fedexData);
                $this->setError('No meter number was obtained, check configuration. Error ' . $fedexData['2'] . ' : ' . $fedexData['3']);
            }
            
            return false;
        }
        
        $meterStart += 6;
        $meterEnd = strpos($fedexData, '"', $meterStart);
        $this->params['meter'] = substr($fedexData, $meterStart, $meterEnd - $meterStart);
        return true;
    }
    
    protected function parseResponse($data)
    {
        $current = 0;
        $length = strlen($data);
        $resultArray = array();
        
        while ($current < $length) {
            $endpos = strpos($data, ',', $current);
            
            if ($endpos === false) { 
                break; 
            }
            
            $index = substr($data, $current, $endpos - $current);
            $current = $endpos + 2;
            $endpos = strpos($data, '"', $current);
            $resultArray[$index] = substr($data, $current, $endpos - $current);
            $current = $endpos + 1;
        }
        
        return $resultArray;
    }
     
    protected function getQuoteFromService($deliveryAddress, $weight, $packageType)
    {
        global $order, $customer_id, $sendto;
        
        if ($this->params['account'] == '') {
            $this->setError('You forgot to set up your Fedex account number, this can be set up in Admin -> Modules -> Shipping');
        }
        
        if ($this->params['original_address']['address'] == '') {
            $this->setError('You forgot to set up your ship from street address line 1, this can be set up in Admin -> Modules -> Shipping');
        }
        
        if ($this->params['original_address']['city'] == '') {
            $this->setError('You forgot to set up your ship from City, this can be set up in Admin -> Modules -> Shipping');
        }
        
        if ($this->params['original_address']['postcode'] == '') {
            $this->setError('You forgot to set up your ship from postal code, this can be set up in Admin -> Modules -> Shipping');
        }
        
        if ($this->params['original_address']['phone'] == '') {
            $this->setError('You forgot to set up your ship from phone number, this can be set up in Admin -> Modules -> Shipping');
        }
        
        if ($this->isErrorSet()) {
            return false;
        }
        
        if ($this->params['meter'] == '') { 
            if ($this->getMeter() === false) {
                return false;
            }
        }
        
        $data = '0,"25"'; // TransactionCode
        $data .= '10,"' . $this->params['account'] . '"'; // Sender fedex account number
        $data .= '498,"' . $this->params['meter'] . '"'; // Meter number
        $data .= '8,"' . $this->params['original_address']['state_iso'] . '"'; // Sender state code
        $origZip = str_replace(array(' ', '-'), '', $this->params['original_address']['postcode']);
        $data .= '9,"' . $origZip . '"'; // Origin postal code
        $data .= '117,"' . $this->params['original_address']['country_iso'] . '"'; // Origin country
        
        if ($deliveryAddress['country_iso'] == 'US' || $deliveryAddress['country_iso'] == 'CA' || $deliveryAddress['country_iso'] == 'PR') {
            $destPostcode = str_replace(array(' ', '-'), '', $deliveryAddress['postcode']);
            $data .= '17,"' . $destPostcode . '"'; // Recipient postcode
            $data .= '16,"' . $deliveryAddress['state_iso'] . '"'; // Recipient state
        }
        
        $data .= '50,"' . $deliveryAddress['country_iso'] . '"'; // Recipient country
        $data .= '75,"' . $this->params['weight_unit'] . '"'; // Weight units
        
        if ($this->params['weight_unit'] == "kgs") {
            $data .= '1116,"C"'; // Dimension units
        }
        else {
            $data .= '1116,"I"'; // Dimension units
        }
        
        $data .= '1401,"' . $weight . '"'; // Total weight
        $data .= '1529,"1"'; // Quote discounted rates
        
        if ($this->params['insurance'] > 0) {
            $data .= '1415,"' . $this->params['insurance'] . '"'; // Insurance value
            $data .= '68,"USD"'; // Insurance value currency
        }
        
        if ($deliveryAddress['company'] == '' && $this->params['residential'] == '') {
            $data .= '440,"Y"'; // Residential address
        }
        else {
            $data .= '440,"N"'; // Business address, use if adding a residential surcharge
        }
        
        $data .= '1273,"' . $packageType . '"'; // Package type
        $data .= '1333,"' . $this->params['dropoff'] . '"'; // Drop of drop off or pickup
        $data .= '99,""'; // End of record
        
        $fedexData = $this->executeRequest($data);
        
        if (strlen($fedexData) == 0) {
            $this->setError('No data returned from Fedex, perhaps the Fedex site is down');
            return false;
        }
        
        $fedexData = $this->parseResponse($fedexData);
        
        $i = 1;
        
        if ($this->params['original_address']['country_iso'] == $deliveryAddress['country_iso']) {
            $this->intl = false;
        }
        else {
            $this->intl = true;
        }
        
        $rates = NULL;
        
        while (isset($fedexData['1274-' . $i])) {
            if ($this->intl) {
                if (isset($this->internationalTypes[$fedexData['1274-' . $i]])) {
                    if (isset($fedexData['3058-' . $i])) {
                        $rates[$fedexData['1274-' . $i] . $fedexData['3058-' . $i]] = $fedexData['1419-' . $i];
                    }
                    else {
                        $rates[$fedexData['1274-' . $i]] = $fedexData['1419-' . $i];
                    }
                }
            }
            else {
                if (isset($this->domesticTypes[$fedexData['1274-' . $i]])) {
                    if (isset($fedexData['3058-' . $i])) {
                        $rates[$fedexData['1274-' . $i] . $fedexData['3058-' . $i]] = $fedexData['1419-' . $i];
                    }
                    else {
                        $rates[$fedexData['1274-' . $i]] = $fedexData['1419-' . $i];
                    }
                }
            }
            $i++;
        }
        
        if (!is_array($rates)) {
            $this->setError('No Rates Returned, ' . $fedexData['2'] . ' : ' . $fedexData['3']);
            return false;
        }
        
        return ((sizeof($rates) > 0) ? $rates : false);
    }
}