<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorNumber validates a number (integer or float). It also converts the input value to a float.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorNumber.class.php 22018 2009-09-14 16:56:28Z fabien $
 */
class sfsValidatorCurrency extends sfValidatorNumber
{
    /**
     * @see sfValidatorNumber
     * @todo merge with other currencies present in the currency table
     */
    protected function doClean($value)
    {
        $value = str_replace(array(',', ' ', '€'), array('.', '', ''), $value);
        return parent::doClean($value);
    }
}
