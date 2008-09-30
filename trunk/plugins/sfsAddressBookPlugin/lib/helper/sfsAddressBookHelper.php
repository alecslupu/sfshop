<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function format_address($address, $useNl = true)
{
    if (is_object($address)) {
        
        $format = null;
        
        if (method_exists(sfContext::getInstance()->getUser(), 'getLocation')) {
            $location = sfContext::getInstance()->getUser()->getLocation();
            $format = AddressFormatPeer::retrieveByLocation($location);
        }
        
        if ($format == null) {
            $format = AddressFormatPeer::retrieveDefault();
        }
        
        $format = $format->getFormat();
        
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
        
        foreach ($array as $key => $value) {
            $format = str_replace($key, $value, $format);
        }
        
        if ($useNl) {
            $format = str_replace('%nl%', '<br/>', $format);
        }
        else {
            $format = str_replace('%nl%', ',', $format);
        }
        
        return $format;
    }
}
