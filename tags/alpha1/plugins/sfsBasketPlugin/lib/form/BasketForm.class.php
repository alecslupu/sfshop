<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Basket form.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class BasketForm extends BaseBasketForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'quantity'   => new sfWidgetFormInput(array(), array('size' => '5')),
                'is_delete'  => new sfWidgetFormInputCheckbox()
             )
        );
        
        $validatorQuantity = new sfValidatorInteger(
            array(
                'required' => true,
                'min'      => 1,
                'max'      => 1
            ),
            array(
                'min' => 'Min product quantity is 1',
                'max' => 'This products does not exist in desired quantity in our stock (Max is %max%).'
            )
        );
        
        $this->setValidators(
            array(
               'quantity'   => $validatorQuantity
            )
        );
        
        $this->defineSfsListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
