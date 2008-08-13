<?php

/**
 * sfsOrderSelectDelivery form.
 *
 * @package    form
 * @subpackage delivery
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsOrderSelectDeliveryForm extends BaseDeliveryForm
{
    public function configure()
    {
        $choices = array();
        
        $this->setWidgets(
            array('method_id' => new sfWidgetFormSelectRadio(array('choices' => $choices)))
        );
        
        $this->widgetSchema->setLabel('method_id', 'Methods');
        
        $validatorMethodId = new sfValidatorChoice(
            array('choices' => $choices)
        );
        
        $this->setValidators(array('method_id' => $validatorMethodId));
        
        $this->getWidgetSchema()->setNameFormat('delivery[%s]');
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        
    }
}
