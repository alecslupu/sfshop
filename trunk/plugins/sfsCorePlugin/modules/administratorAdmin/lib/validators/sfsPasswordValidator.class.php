<?php
/**
 * sfsPasswordValidator
 *
 * @package    symfony
 * @subpackage validator
 * @author     Andrey Kotlyarov
 */

class sfsPasswordValidator extends sfValidator
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
        $re = '/^.{6,12}$/';
        
        if (!preg_match($re, $value)) {
            $error = $this->getParameterHolder()->get('password_error');
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
        $this->getParameterHolder()->set('password_error', 'Invalid input');
        
        $this->getParameterHolder()->add($parameters);
        
        return true;
    }
}
