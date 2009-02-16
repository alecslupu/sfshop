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
 * OptionValue form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class OptionValueForm extends BaseOptionValueForm
{
    public function configure()
    {
        parent::configure();
        
        $widgetTypeId = new sfWidgetFormPropelChoice(
            array(
                'model'        => 'OptionType',
                'peer_method'  => 'getAll',
                'add_empty'    => true
            )
        );
        
        $this->setWidget('type_id', $widgetTypeId);
        
        $this->offsetUnset('is_deleted');
        
        $validatorTypeId = new sfValidatorPropelChoice(
            array('model' => 'OptionType', 'column' => 'id'),
            array('required' => 'Option type is a required field')
        );
        
        $this->setValidator('type_id', $validatorTypeId);
        
        $this->embedI18nForAllCultures();
    }
}
