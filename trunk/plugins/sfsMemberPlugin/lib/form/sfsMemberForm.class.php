<?php

/**
 * sfsMember form.
 *
 * @package    form
 * @subpackage members
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberForm extends BasesfsMemberForm
{
    public function configure()
    {
    }

    /**
    * Binds the form with input values.
    *
    * It triggers the validator schema validation.
    *
    * @param array An array of input values
    * @param array An array of uploaded files (in the $_FILES or $_GET format)
    * @author Dmitry Nesteruk
    * @access public
    */
    public function bind(array $taintedValues = null, array $taintedFiles = array())
    {
        $request = sfContext::getInstance()->getRequest();
        
        if ($request->hasParameter(self::$CSRFFieldName))
        {
            $taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
