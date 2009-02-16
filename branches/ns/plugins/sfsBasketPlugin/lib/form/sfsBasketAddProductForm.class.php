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
 * Basket add product form.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsBasketAddProductForm extends BasketForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetSet('product_id', new sfWidgetFormInputHidden());
        $this->getWidgetSchema()->offsetUnset('is_delete');
        
        /*
        $validatorProductId = new sfValidatorInteger(
            array(
                'required' => true,
            ),
            array(
                'invalid' => 'You have incorrect product id'
            )
        );
        */
        //$this->getValidatorSchema()->offsetSet('product_id', $validatorProductId);
        $this->setDefault('quantity', 1);
        $this->getWidgetSchema()->setNameFormat('add_product[%s]');
    }
}