<?php
/**
 * sfsCredentialValidator
 *
 * @package    symfony
 * @subpackage validator
 * @author     Andrey Kotlyarov
 */

class sfsCredentialValidator extends sfValidator
{
    private function checkCredential($model, $value)
    {
        $possibleCredentials = sfConfig::get('app_credentials_' . $model);
        foreach (explode(',', $value) as $credential) {
            $credential = preg_replace("/(\s+$|^\s+)/", '', $credential);
            
            if ($credential != '' && !in_array($credential, $possibleCredentials)) {
                return false;
            }
        }
        
        return true;
    }
    
    
   /**
    * Executes this validator.
    *
    * @param mixed A file or parameter value/array
    * @param error An error message reference
    *
    * @return bool true, if this validator executes successfully, otherwise false
    */
    public function execute(&$value, &$error)
    {
        $model = $this->getParameterHolder()->get('model');
        
        if (!$this->checkCredential($model, $value)) {
            $error = $this->getParameterHolder()->get('credential_error');
            return false;
        }
        
        return true;
    }
    
    
    
    
   /**
    * Initializes this validator.
    *
    * @param sfContext The current application context
    * @param array   An associative array of initialization parameters
    *
    * @return bool true, if initialization completes successfully, otherwise false
    */
    public function initialize($context, $parameters = null)
    {
        // initialize parent
        parent::initialize($context);
        
        // set defaults
        $this->getParameterHolder()->set('credential_error', 'Invalid input');
        $this->getParameterHolder()->set('model', null);
        
        $this->getParameterHolder()->add($parameters);
        
        return true;
    }
}
