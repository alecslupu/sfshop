<?php

/**
 * OptionProduct form.
 *
 * @package    form
 * @subpackage option_product
 * @version    SVN: $Id$
 */
class OptionProductForm extends BaseOptionProductForm
{
    public function configure()
    {
        unset($this['id'],$this['product_id']);
    }
}
