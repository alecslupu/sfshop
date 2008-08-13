<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfPropelFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormPropel extends sfFormPropel
{
    public function setup()
    {
    }
    
   /**
    * Define error
    *
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @param string $fieldName
    * @param string $message
    * @return void
    */
    public function defineError($fieldName, $message)
    {
        $checkName = 'check_define_' . md5($fieldName);
        $this->getErrorSchema()->getValidator()->addOption($checkName);
        $this->getErrorSchema()->getValidator()->addMessage($checkName, $message);
        
        $this->getErrorSchema()->addError(
            new sfValidatorError(
                $this->getErrorSchema()->getValidator(),
                $checkName,
                array(
                    'value' => sfContext::getInstance()->getRequest()->getParameter($fieldName),
                    $checkName => $this->getErrorSchema()->getValidator($checkName)
                )
            )
        );
    }
    
}
