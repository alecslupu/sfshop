<?php

/**
 * sfsUniqueValidator
 *
 * @package    symfony
 * @subpackage validator
 * @author     Andrey Kotlyarov
 */

class sfsUniqueValidator extends sfValidator
{
    
    private function checkUnique($className, $id, $fieldName, $value)
    {
        $c = new Criteria();
        $c->add(constant($className . 'Peer::ID'), $id, Criteria::NOT_EQUAL);
        $c->add(constant($className . 'Peer::' . strtoupper($fieldName)), $value, Criteria::EQUAL);
        
        $count = call_user_func(
            array(
                $className . 'Peer',
                'doCount'
            ),
            $c
        );
        
        return ($count == 0);
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
        $class_name = $this->getParameterHolder()->get('class_name');
        $id_name    = $this->getParameterHolder()->get('id_name');
        $field_name = $this->getParameterHolder()->get('field_name');
        $id         = sfContext::getInstance()->getRequest()->getParameter($id_name);
        
        if (!$this->checkUnique($class_name, $id, $field_name, $value)) {
            $error = $this->getParameterHolder()->get('unique_error');
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
        $this->getParameterHolder()->set('unique_error', 'Invalid input');
        $this->getParameterHolder()->set('class_name', null);
        $this->getParameterHolder()->set('id_name', 'id');
        $this->getParameterHolder()->set('field_name', 'NAME');
        
        
        $this->getParameterHolder()->add($parameters);
        
        return true;
    }
}
