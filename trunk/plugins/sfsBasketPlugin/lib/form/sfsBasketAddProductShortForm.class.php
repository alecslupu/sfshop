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
 * Basket add product short form.
 *
 * @package    plugin.sfsBasketPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsBasketAddProductShortForm extends sfsBasketAddProductForm
{
    public function configure()
    {
        parent::configure();
        
        $this->getWidgetSchema()->offsetUnset('quantity');
        $this->getWidgetSchema()->offsetSet('quantity', new sfWidgetFormInputHidden());
    }
}