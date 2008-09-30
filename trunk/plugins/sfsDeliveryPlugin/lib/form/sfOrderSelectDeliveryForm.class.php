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
 * Select delivery service form.
 *
 * @package    plugin.sfsDeliveryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsOrderSelectDeliveryForm extends BaseDeliveryForm
{
    public function configure()
    {
        $choices = array();
        
        $this->setWidgets(
            array('method_id' => new sfWidgetFormSelectRadio(array('choices' => $choices, 'formatter'=> array('DeliveryForm','radioFormatter'))))
        );
        
        $this->widgetSchema->setLabel('method_id', 'Methods');
        
        $validatorMethodId = new sfValidatorChoice(
            array('choices' => array_keys($choices)),
            array('required' => 'Please select a some delivery method')
        );
        
        $this->setValidators(array('method_id' => $validatorMethodId));
        
        $this->getWidgetSchema()->setNameFormat('delivery[%s]');
        $this->defineSfsListFormatter();
        
    }
}
