<?php

/**
 * OptionProduct form.
 *
 * @package    form
 * @subpackage option_product
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
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
            
            if ($optionProduct->getPrice() > 0) {
                $symbol = '+';
            }
            
            $title = $optionValue->getTitle() . '  (' . $symbol . format_currency($optionProduct->getPrice()) . ')';
            
            $choices[$optionTypeName][$optionProduct->getId()] = $title;
            $optionTypes[$optionTypeName] = $optionValue->getOptionType()->getTitle();
        }
        
        $this->getWidgetSchema()->addFormFormatter(
            'sfs_list', 
            new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema())
        );
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        
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
        
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
    }
}
