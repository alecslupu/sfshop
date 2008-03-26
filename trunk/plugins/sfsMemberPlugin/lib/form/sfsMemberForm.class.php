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
  
    public function bind($taintedValues, $taintedFiles)
    {
        $request = sfContext::getInstance()->getRequest();
        
        if ($request->hasParameter(self::$CSRFFieldName))
        {
            $taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
