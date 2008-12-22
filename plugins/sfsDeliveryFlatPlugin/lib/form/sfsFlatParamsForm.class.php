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
 * Form for edit parameters for Flat service.
 *
 * @package    plugin.sfsDeliveryFlatPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsFlatParamsForm extends DeliveryForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'title'       => new sfWidgetFormInput(),
                'price'       => new sfWidgetFormInput()
             )
        );
        
        $this->getWidgetSchema()->setLabel('title', 'Method title');
        
        $validatorTitle = new sfValidatorString(
            array(
                'required' => true
            ),
            array(
                'required' => 'You should input method title'
            )
        );
        
        $validatorPrice = new sfValidatorNumber(
            array(
                'required' => true,
            ),
            array('invalid'  => 'Price must contain only numerals')
        );
        
        $this->setValidators(
            array(
                'title' => $validatorTitle,
                'price' => $validatorPrice
             )
        );
        
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
