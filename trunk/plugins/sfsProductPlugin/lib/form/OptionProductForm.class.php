<?php

/**
 * OptionProduct form.
 *
 * @package    form
 * @subpackage option_product
 * @version    SVN: $Id$
 */
class OptionProductForm extends BaseOptionProductForm
{
    public function configure()
    {
        unset(
            $this['id'],
            $this['basket_product2_option_product_list']
        );
        $this->setWidget('product_id', new sfWidgetFormInputHidden);
        $this->validatorSchema['quantity'] = new sfValidatorNumber(array('required' => false));
        
        if($this->isNew())
        {
            $this->configureForNew();
        }
        else
        {
            $c = new Criteria;
            if($this->getObject()->getOptionType())
            {
                $c->add(OptionValuePeer::TYPE_ID, $this->getObject()->getOptionType()->getId());
            }
            $this->setWidget('option_value_id', new sfWidgetFormPropelChoice(array('model' => 'OptionValue', 'criteria' => $c, 'add_empty' => false)));
            $this->setValidator('option_value_id', new sfValidatorPropelChoice(array('model' => 'OptionValue', 'criteria' => $c, 'column' => 'id')));
        }
    }
    
    public function configureForNew()
    {
        $options = $options_id = array();
        foreach(OptionValuePeer::getAll(null, true) as $ov)
        {
            $options[$ov->getOptionType()->getTitle()][$ov->getId()] = (string) $ov;
            $options_id[] = $ov->getId();
        }
        $this->setWidget('option_value_id', new sfWidgetFormChoice(array('choices' => $options)));
        $this->setValidator('option_value_id', new sfValidatorChoice(array('choices' => $options_id)));
    }
}
