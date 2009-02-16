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
    * Format address for view
    *
    * @param  mixed $address, bool $useNl = true, bool $isFieldsInContainer = false
    * @return string
    * @author Dmitry Nesteruk, Andreas Nyholm
    */

function format_address($address, $useNl = true, $isFieldsInContainer = false)
{   
    if(is_array($address)) {
        $array = array();
        foreach ($address as $key => $value) {
            $key = str_replace('%', '',$key);
            $array['%'.$key.'%'] = $value;
        }
    }
    else if(is_object($address)) {
        if ($address->getStateId() !== null) {
            $state = StatePeer::retrieveByPK($address->getStateId())->getTitle();
        }
        else {
            $state = $address->getStateTitle();
        }
        
        $array = array(
            '%first_name%' => $address->getFirstName(),
            '%last_name%'  => $address->getLastName(),
            '%country%'    => CountryPeer::retrieveByPK($address->getCountryId())->getTitle(),
            '%state%'      => $state,
            '%city%'       => $address->getCity(),
            '%street%'     => $address->getStreet(),
            '%postcode%'   => $address->getPostcode()
        );
    }
    else
        throw new Exception('address is not valid format');
    
    $format = null;
    
    if (method_exists(sfContext::getInstance()->getUser(), 'getLocation')) {
        $location = sfContext::getInstance()->getUser()->getLocation();
        $format = AddressFormatPeer::retrieveByLocation($location);
    }
    
    if ($format == null) {
        $format = AddressFormatPeer::retrieveDefault();
    }
    
    $format = $format->getFormat();
            
    foreach ($array as $key => $value) {
        if ($isFieldsInContainer) {
            $fieldName = str_replace('%', '', $key);
            $format = str_replace($key, '<span class="' . $fieldName . '">' . $value . '</span>', $format);
        }
        else {
            $format = str_replace($key, $value, $format);
        }
    }

    if ($useNl) {
        $format = str_replace('%nl%', '<br/>', $format);
    }
    else {
        $format = str_replace('%nl%', ',', $format);
    }

    return $format;
}
