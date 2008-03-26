<?php
/**
 * 
 * Validator makes a comparison between two string.
 * 
 * @package    sfShop
 * @subpackage plugins.sfsCorePlugin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfGuardUserValidator.class.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfsValidatorCompare extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * check
   *
   * Available error codes:
   *
   *  * check
   *
   * @see sfValidatorBase
   */
    protected function configure($options = array(), $messages = array())
    {
        $this->addOption('check');
    }

    /**
    * Makes a comparison between two string
    * 
    * @param  string $value comparisons value
    * @return string $clean comparisons value
    * @author Dmitry Nesteruk
    * @access public
    */
    protected function doClean($value)
    {
        $clean = $value;
        $checkValue = sfContext::getInstance()->getRequest()->getParameter($this->getOption('check'));

        if ($checkValue != $value) {
            throw new sfValidatorError($this, 'invalid', array('value' => $value));
        }

        return $clean;
    }
}

