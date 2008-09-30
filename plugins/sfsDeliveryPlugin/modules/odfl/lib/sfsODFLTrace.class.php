<?php

/**
 * 
 * @package    sfsShippingPlugin
 * @author     Andrey Kotlyarov
 */
class sfsODFLTrace
{
    protected $_wsdl       = 'http://www.odfl.com/TraceWebServiceWeb/services/Trace/wsdl/Trace.wsdl';
    protected $_soapClient = null;
    protected $_traceData  = null;
    
    
    
    public function __construct()
    {
        $this->_soapClient = new SoapClient($this->_wsdl);
    }
    
    
    
    public function call_getTraceData($params = array(), $defaultValue = null)
    {
        $args = array();
        $args['parameters'] = array();
        
        $args['parameters']['pro'] = (isset($params['pro']) ? $params['pro'] : $defaultValue);
        $args['parameters']['type'] = (isset($params['type']) ? $params['type'] : $defaultValue);
        
        $this->_traceData = $this->_soapClient->__call('getTraceData', $args);
    }
    
    
    
    
    
   /**
    * getTraceData by key
    *
    * $key in list:
    * -------------------------------------------------------------------------
    * proNum
    * proDate
    * statusCode
    * status
    * appointment
    * pieces
    * weight
    * po
    * bol
    * trailer
    * signature
    * origTerminal
    * origAddress
    * origState
    * origName
    * origCity
    * origZip
    * origPhone
    * origFax
    * destTerminal
    * destAddress
    * destState
    * destName
    * destCity
    * destZip
    * destPhone
    * destFax
    * delivered
    * url
    * type
    * scac
    * errorMessage
    * guaranteed
    * call
    * -------------------------------------------------------------------------
    */
    public function getTraceData($key = null, $subkey = null)
    {
        $data = null;
        
        if ($key === null) {
            $data = $this->_traceData;
        } else {
            if ($subkey === null) {
                if (isset($this->_traceData->getTraceDataReturn->{$key})) {
                    $data = $this->_traceData->getTraceDataReturn->{$key};
                }
            } else {
                if (isset($this->_traceData->getTraceDataReturn->{$key}->{$subkey})) {
                    $data = $this->_traceData->getTraceDataReturn->{$key}->{$subkey};
                }
            }
        }
        
        return $data;
    }
    
    
    
}