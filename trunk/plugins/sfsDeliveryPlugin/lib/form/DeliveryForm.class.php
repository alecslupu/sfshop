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
 * Delivery form.
 *
 * @package    plugin.sfsDeliveryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class DeliveryForm extends BaseDeliveryForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'id'         => new sfWidgetFormInputHidden(),
                'is_active'  => new sfWidgetFormInputCheckbox()
             )
        );
        
        $this->setValidators(
            array(
                'id'        => new sfValidatorPropelChoice(array('model' => 'Delivery', 'column' => 'id', 'required' => false)),
                'is_active' => new sfValidatorBoolean(),
            )
        );
        
        //embed i18n form
        $languages = LanguagePeer::getAllPublic();
        $cultures = array();
        
        foreach ($languages as $language) {
            $cultures[] = $language->getCulture();
        }
        
        $this->embedI18n($cultures);
        
        foreach ($languages as $language) {
            $this->getWidgetSchema()->setLabel($language->getCulture(), $language->getTitleEnglish());
        }
        
        //embed params form
        $params = sfsJSONPeer::decode($this->getObject()->getParams());
        $className = $this->getObject()->getNameClassFormParams();
        
        $formParams = new $className();
        
        foreach ($params as $key => $value) {
            $formParams->setDefault($key, $value);
        }
        
        $this->embedForm('_params', $formParams);
        
        $this->getWidgetSchema()->setNameFormat('delivery[%s]');
    }
}
