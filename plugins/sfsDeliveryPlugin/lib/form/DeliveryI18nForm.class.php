<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * DeliveryI18n form.
 *
 * @package    plugin.sfsDeliveryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class DeliveryI18nForm extends BaseDeliveryI18nForm
{
    public function configure()
    {
        $this->setWidget('title', new sfWidgetFormInput(array(), array('size' => 80)));
        $this->setWidget('description', new sfWidgetFormTextarea(array(), array('cols' => 70, 'rows' => 4)));
        
        $validatorTitle = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 4,
                'max_length' => 100
            ),
            array(
                'required'   => 'Title is a required field',
                'min_length' => 'Title must be 4 or more characters',
                'max_length' => 'Title can not be more 100 characters'
            )
        );
        
        $validatorDescription = new sfValidatorString(
            array(
                'required'   => false,
                'max_length' => 200
            ),
            array(
                'max_length' => 'Description can not be more 200 characters'
            )
        );
        
        $this->setValidator('title', $validatorTitle);
        $this->setValidator('description', $validatorDescription);
    }
}
