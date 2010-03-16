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
        sfContext::getInstance()->getConfiguration()->loadHelpers('sfsCurrency');

        unset($this['id']);
        
        $this->setWidgets(array());
        $this->setValidators(array());
        
        $product = $this->getObject();
        $c = new Criteria();
        $c->addAscendingOrderByColumn(OptionValuePeer::POS);
        $options = $product->getOptionProductsJoinOptionValue($c);
        
        $choices = array();
        $optionTypes = array();
        
        foreach ($options as $optionProduct) {
            if(($product->getQuantity() === null && ($optionProduct->getQuantity() == 0 && $optionProduct->getQuantity() !== null) && !$product->getAllowOutOfStock()))
               continue; // do not display if out of stock and "allow out of stock" is false  
        	  $optionTypeName = $optionProduct->getOptionValue()->getOptionType()->getId();
            $optionValue = $optionProduct->getOptionValue();
            
            $symbol = '';
            
            $title = $optionValue->getTitle();
            
            if ($optionProduct->getProductPrice() > 0) {
                $symbol = '+';
            }
            else if($optionProduct->getProductPrice() < 0) {
                $symbol = '-';
            }
            if($optionProduct->getProductPrice() != 0)
                $title .= '  (' . $symbol . format_currency($optionProduct->getProductPrice()) . ')';
            
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
            
            $this->getWidgetSchema()->setLabel($key, $optionTypes[$key]);
        }
        
        $this->defineSfsListFormatter();
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
    }
}
