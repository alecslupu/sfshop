<?php
/**
 * sfsNameValidator
 *
 * @package    symfony
 * @subpackage validator
 * @author     Andrey Kotlyarov
 */

class sfsNameValidator extends sfValidator
{
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
        $re = '/^[a-z][a-z0-9_\-]+$/';
        
        if (!preg_match($re, $value)) {
            $error = $this->getParameterHolder()->get('name_error');
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
        $this->getParameterHolder()->set('name_error', 'Invalid input');
        
        $this->getParameterHolder()->add($parameters);
        
        return true;
    }
}
