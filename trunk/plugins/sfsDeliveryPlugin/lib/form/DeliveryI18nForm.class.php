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
        $this->setWidget('description', new sfWidgetFormInput(array(), array('size' => 80)));
        
        $validatorTitle = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 1,
                'max_length' => 100
            ),
            array(
                'required'   => 'You must input title',
                'min_length' => 'Title must be 1 or more characters',
                'max_length' => 'Title must be 100 or less characters'
            )
        );
        
        $validatorDescription = new sfValidatorString(
            array(
                'required'   => false,
                'max_length' => 200
            ),
            array(
                'max_length' => 'Title must be 200 or less characters'
            )
        );
        
        $this->setValidator('title', $validatorTitle);
        $this->setValidator('description', $validatorDescription);
    }
}
