<?php

/**
 * OptionProduct form.
 *
 * @package    form
 * @subpackage option_product
 * @version    SVN: $Id$
 */
class sfsProductOptionsForm extends BaseProductForm
{
    public function configure()
    {
        sfLoader::loadHelpers('sfsCurrency');
        
        $this->setWidgets(array());
        $this->setValidators(array());
        
        $product = $this->getObject();
        $options = $product->getOptionProductsJoinOptionValue();
        
        $choices = array();
        $optionTypes = array();
        
        foreach ($options as $optionProduct) {
            $optionTypeName = $optionProduct->getOptionValue()->getOptionType()->getName();
            $optionValue = $optionProduct->getOptionValue();
            
            $symbol = '';
            
            if ($optionProduct->getProductPrice() > 0) {
                $symbol = '+';
            }
            
            $title = $optionValue->getTitle() . '  (' . $symbol . format_currency($optionProduct->getProductPrice()) . ')';
            
            $choices[$optionTypeName][$optionProduct->getId()] = $title;
            $optionTypes[$optionTypeName] = $optionValue->getOptionType()->getTitle();
        }
        
        foreach ($choices as $key => $values) {
            $this->getWidgetSchema()->offsetSet($key, new sfWidgetFormSelect(array('choices' => $values)));
            $this->getValidatorSchema()->offsetSet(
                $optionTypes[$key], 
                new sfValidatorChoice(
                    array('choices' => $values, 'required' => false),
                    array('invalid' => 'Please select a option')
                )
            );
            
            $this->getWidgetSchema()->setLabel('option', $optionTypes[$key]);
        }
        
        $this->defineSfsListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
