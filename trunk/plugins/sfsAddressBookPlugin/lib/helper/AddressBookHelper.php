<?php

function format_address($address)
{
    if (is_object($address)) {
        
        $location = sfContext::getInstance()->getUser()->getLocation();
        $format = sfsAddressFormatPeer::retrieveByLocation($location);
        
        if ($format == null) {
            $format = sfsAddressFormatPeer::retrieveDefault();
        }
        
        $format = $format->getFormat();
        
        $array = array(
            '%first_name%' => $address->getFirstName(),
            '%last_name%'  => $address->getLastName(),
            '%country%'    => format_country($address->getCountryCid()),
            '%state%'      => $address->getState(),
            '%city%'       => $address->getCity(),
            '%street%'     => $address->getStreet(),
            '%postcode%'   => $address->getPostcode()
        );
        
        foreach ($array as $key => $value) {
            $format = str_replace($key, $value, $format);
        }
        
        return $format;
    }
}
