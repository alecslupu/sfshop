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
 * OrderStatus form.
 *
 * @package    plugins.sfsOrderPlugin
 * @subpackage modules.orderAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id$
 */
class sfsOrderChangeStatusForm extends BaseOrderItemForm
{
    public function configure()
    {
        
        $arrayOrderStatuses = OrderStatusPeer::getHashAll();
        
        $this->setWidgets(
            array(
                'id'        => new sfWidgetFormInputHidden(),
                'status_id' => new sfWidgetFormSelect(array('choices' => $arrayOrderStatuses))
            )
        );
        
        $this->getWidgetSchema()->setLabel('status_id', 'Status');
        
        $validatorStatusId = new sfValidatorChoice(
            array('choices' => array_keys($arrayOrderStatuses))
        );
        
        $this->setValidators(
            array(
                'id'         => new sfValidatorPropelChoice(array('model' => 'OrderItem', 'column' => 'id', 'required' => false)),
                'status_id' => $validatorStatusId
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('order_item[%s]');
        $this->defineSfsAdminListFormatter();
    }
}
