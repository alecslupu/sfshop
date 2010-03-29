<?php

/**
 * Product form.
 *
 * @package    form
 * @subpackage products
 * @version    SVN: $Id$
 */
class ProductForm extends BaseProductForm
{
    public function configure()
    {
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);
        
        $this->embedI18nForAllCultures();
        
        sfProjectConfiguration::getActive()->loadHelpers('sfsCategory');

        unset(
            $this['id'],
            $this['created_at'],
            $this['updated_at'],
            $this['has_options'],
            $this['is_deleted']
        );
        
        if(!sfConfig::get('app_tax_is_enabled',false)) 
        {
            unset($this['tax_type_id'], $this['price_gross']);
        }

        //$this->widgetSchema['product2_category_list'] = new sfWidgetFormPropelChoiceMany(array('model' => 'Category', 'peer_method' => 'getTreeForChoice'));
        $this->widgetSchema['product2_category_list'] = new sfWidgetFormChoice(array('multiple'=>true,'choices' => get_categories_tree_for_select(false)), array('size' => '10'));
        //$this->setWidget('product2_category_list', new sfWidgetFormTextBoxList(array('url' => '/admin/categoryAdmin/getTextBoxList', 'model' => 'Category')));

        $this->widgetSchema['tax_type_id'] = new sfWidgetFormPropelChoice(array('model' => 'TaxType', 'peer_method' => 'getTaxRatesByName', 'add_empty' => true),array('onchange' => 'taxRateChanged()'));
        $this->widgetSchema['price'] = new sfWidgetFormInput(array('default' => $this->object->getNetPrice()),array('class' => 'product_price', 'onkeyup' => 'updateGrossPrice(\'product_price\')'));
        $this->widgetSchema['price_gross'] = new sfWidgetFormInput(array('default' => $this->object->getGrossPrice()),array('onkeyup' => 'updateNetPrice(\'product_price\')'));

        $this->validatorSchema['price'] = new sfsValidatorCurrency(array('required' => true));
        $this->validatorSchema['price_gross'] = new sfsValidatorCurrency(array('required' => false));
        $this->validatorSchema['promo_price'] = new sfsValidatorCurrency(array('required' => false));
        $this->validatorSchema['weight'] = new sfValidatorNumber(array('required' => false));
        $this->validatorSchema['quantity'] = new sfValidatorNumber(array('required' => false));

        $this->widgetSchema->setLabels(array(
            'is_active'         => 'Active?',
            'tax_type_id'       => 'Tax type',
            'price'             => 'Net price',
            'price_gross'       => 'Gross price',
            'allow_out_of_stock' => 'Allow OS?',
            'product2_category_list' => 'Categories',
            'brand_id'          => 'Brand',
        ));
        $this->widgetSchema->setHelp('allow_out_of_stock', 'Allow user to order product if product is out of stock?');
        $this->widgetSchema->setHelp('stock_message', 'The message to show if OS allowed');

        $this->embedOptionsForm();
        
        $this->embedThumbnailForm();
    }
    
    public function embedOptionsForm()
    {
        $opWrapperForm = new sfForm;
        foreach($this->getObject()->getOptionProducts() as $optionproduct)
        {
            $opWrapperForm->embedForm($optionproduct->getId(), new OptionProductForm($optionproduct));
            $opWrapperForm->getWidgetSchema()->setLabel($optionproduct->getId(), (string) $optionproduct->getOptionType());
        }
        
        $opWrapperForm->setWidget('add_new_option', new sfWidgetFormInputCheckbox);
        $opWrapperForm->setValidator('add_new_option', new sfValidatorBoolean(array('required' => false)));
        
        $new_op_form = new OptionProductForm;
        $new_op_form->setDefault('product_id', $this->getObject()->getId());
        $opWrapperForm->embedForm('new_option_product', $new_op_form);
        
        $this->embedForm('options_product', $opWrapperForm);
    }
    
    public function save($con = null)
    {
        $this->preSaveThumbnail();
        
        if( ! isset($this->taintedValues['options_product']['add_new_option']) 
        or (isset($this->taintedValues['options_product']['add_new_option']) and ! $this->taintedValues['options_product']['add_new_option'])) {
            //if the "new option" checkbox is unchecked, we don't want to add a new one 
            // so we unset it to avoid the sfForm::save method to insert it anyway. 
            $this->getEmbeddedForm('options_product')->offsetUnset('new_option_product');
        }
        foreach($this->getEmbeddedForm('options_product')->getEmbeddedForms() as $id => $op_form) 
        {
            if( isset($this->taintedValues['options_product'][$id]['delete_option']) and $this->taintedValues['options_product'][$id]['delete_option']) {
                // if the "delete option" checkbox is checked, we want to delete it,
                // so we unset it to avoid the sfForm::save method to reinsert it after having deleted it. 
                $this->getEmbeddedForm('options_product')->offsetUnset($id);
                $op_form->getObject()->delete();
            }
        }
        
        parent::save($con);
        
        $this->postSaveThumbnail();
        
        return $this->getObject();
    }
}
