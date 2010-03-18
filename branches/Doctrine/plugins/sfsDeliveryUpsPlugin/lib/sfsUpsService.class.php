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
 * Gets available methods for shipping via Federal express service and calculates shipping costs for each method.
 *
 * @package    plugins.sfDeliveryUpsPlugin
 * @subpackage lib
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfAction.class.php 9477 2008-06-09 09:41:14Z fabien $
 */
class sfsUpsService extends sfsBaseDeliveryService
{

    protected $types = array(
        '1DM'    => 'Next Day Air Early AM',
        '1DML'   => 'Next Day Air Early AM Letter',
        '1DA'    => 'Next Day Air',
        '1DAL'   => 'Next Day Air Letter',
        '1DAPI'  => 'Next Day Air Intra (Puerto Rico)',
        '1DP'    => 'Next Day Air Saver',
        '1DPL'   => 'Next Day Air Saver Letter',
        '2DM'    => '2nd Day Air AM',
        '2DML'   => '2nd Day Air AM Letter',
        '2DA'    => '2nd Day Air',
        '2DAL'   => '2nd Day Air Letter',
        '3DS'    => '3 Day Select',
        'GND'    => 'Ground',
        'GNDCOM' => 'Ground Commercial',
        'GNDRES' => 'Ground Residential',
        'STD'    => 'Canada Standard',
        'XPR'    => 'Worldwide Express',
        'XPRL'   => 'worldwide Express Letter',
        'XDM'    => 'Worldwide Express Plus',
        'XDML'   => 'Worldwide Express Plus Letter',
        'XPD'    => 'Worldwide Expedited'
    );
    
    public function getQuote()
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('sfsCurrency'));
        
        $deliveryAddress = $this->getDeliveryAddress();
        $storeAddress    = $this->getStoreAddress();
        $params          = $this->getParams();
        
        $data = array();
        
        if ($deliveryAddress['country_iso'] == 'CA') {
            $data['product_code'] = 'STD';
        }
        else {
            $data['product_code'] = 'GNDRES';
        }
        
        $data['store_postcode'] = $storeAddress['postcode'];
        $data['store_country_iso'] = $storeAddress['country_iso'];
        
        if ($deliveryAddress['country_iso'] == 'us') {
            $data['delivery_postcode'] = substr($deliveryAddress['postcode'], 0, 5);
        }
        else {
            $data['delivery_postcode'] = $deliveryAddress['postcode'];
        }
        
        $data['delivery_country_iso'] = $deliveryAddress['country_iso'];
        
        switch ($params['pickup_method']) {
            case 'rdp':
                $data['rate_code'] = 'Regular+Daily+Pickup';
                break;
            case 'oca':
                $data['rate_code'] = 'On+Call+Air';
                break;
            case 'otp':
                $data['rate_code'] = 'One+Time+Pickup';
                break;
            case 'lc':
                $data['rate_code'] = 'Letter+Center';
                break;
            case 'cc':
                $data['rate_code'] = 'Customer+Counter';
                break;
        }
        
        switch ($params['package']) {
            case 'cp': // Customer Packaging
                $data['container_code'] = '00';
                break;
            case 'ule': // UPS Letter Envelope
                $data['container_code'] = '01';
                break;
            case 'ut': // UPS Tube
                $data['container_code'] = '03';
                break;
            case 'ueb': // UPS Express Box
                $data['container_code'] = '21';
                break;
            case 'uw25': // UPS Worldwide 25 kilo
                $data['container_code'] = '24';
                break;
            case 'uw10': // UPS Worldwide 10 kilo
                $data['container_code'] = '25';
                break;
        }
        
        $data['weight'] = $this->getTotalWeight();
        
        switch ($params['residential']) {
            case 'res': // Residential Address
                $data['res_code'] = '1';
                break;
            case 'com': // Commercial Address
                $data['res_code'] = '2';
                break;
        }
        
        $upsQuote = $this->executeRequest($data);
        $quotes = array();
        
        if ((is_array($upsQuote)) && (sizeof($upsQuote) > 0)) {
            
            $methods = array();
            $allowedMethods = $params['methods'];
            
            $stdRcd = false;
            $qsize = sizeof($upsQuote);
            
            for ($i=0; $i < $qsize; $i++) {
                
                list($type, $price) = each($upsQuote[$i]);
                
                if ($type=='STD') {
                    if ($stdRcd) {
                        continue;
                    }
                    else {
                        $stdRcd = true;
                    }
                }
                
                if (!in_array($type, $allowedMethods)) {
                    continue;
                }
                
                $price = exchange_to_default_currency($price, 'USD', true);
                
                $methods[] = array(
                    'id'    => $type,
                    'title' => $this->types[$type],
                    'price' => ($price + $params['handling']) * $this->getNumBoxes()
                );
            }
            
            return $methods;
        }
    }
    
    protected function executeRequest($data)
    {
        $request = join('&', 
            array(
                'accept_UPS_license_agreement=yes',
                '10_action=' . 4,
                '13_product=' . $data['product_code'],
                '14_origCountry=' . $data['store_country_iso'],
                '15_origPostal=' . $data['store_postcode'] ,
                '19_destPostal=' . $data['delivery_postcode'],
                '22_destCountry=' . $data['delivery_country_iso'],
                '23_weight=' . $data['weight'],
                '47_rate_chart=' . $data['rate_code'],
                '48_container=' . $data['container_code'],
                '49_residential=' . $data['res_code']
            )
        );
        
        $browser = new sfWebBrowser();
        $browser->get('http://www.ups.com/')->get('/using/services/rave/qcostcgi.cgi?' . $request);
        $body = $browser->getResponseText();
        
        $bodyArray = explode("\n", $body);
        
        $res = array();
        
        foreach($bodyArray as $body) {
            
            $array = explode('%',$body);
            $errorCode = substr($array[0], -1);
            
            switch ($errorCode) {
                case 3:
                  $res[] = array($array[1] => $array[8]);
                  break;
              case 4:
                  $res[] = array($array[1] => $array[8]);
                  break;
              case 5:
                  $this->logMessage('Delivery (Ups service): ' . $array[1]);
                  break;
              case 6:
                  $res[] = array($array[3] => $array[10]);
                  break;
            }
        }
        
        return $res;
    }
}
