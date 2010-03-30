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

        ProjectConfiguration::getActive()->loadHelpers('sfsCategory');

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

        //$this->widgetSchema['product2_category_list'] = new sfWidgetFormChoice(array('multiple'=>true,'choices' => get_categories_tree_for_select(false)));
        //$this->setWidget('product2_category', new sfWidgetFormTextBoxList(array('url' => '/admin/categoryAdmin/getTextBoxList', 'model' => 'Category')));
        $wrapper_form = new sfForm;
        foreach(CategoryPeer::getFirstLevel() as $cat)
        {
            $wrapper_form->setWidget((string) $cat, new sfWidgetFormCategoryChoiceMany(array('category' => $cat)));
            $wrapper_form->setValidator((string) $cat, new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)));
            $wrapper_form->setDefault((string) $cat, $this->getDefaultCategories($cat));
        }
        $this->embedForm('product2_category_list', $wrapper_form);

        $this->widgetSchema['tax_type_id'] = new sfWidgetFormPropelChoice(array('model' => 'TaxType', 'peer_method' => 'getTaxRatesByName', 'add_empty' => true),array('onchange' => 'taxRateChanged()'));
        $this->widgetSchema['price'] = new sfWidgetFormInput(array('default' => $this->object->getNetPrice()),array('class' => 'product_price', 'onkeyup' => 'updateGrossPrice(\'product_price\')'));
        $this->widgetSchema['price_gross'] = new sfWidgetFormInput(array('default' => $this->object->getGrossPrice()),array('onkeyup' => 'updateNetPrice(\'product_price\')'));

        $this->setWidget('stock_message', new sfWidgetFormChoice(array('choices' => $this->getStockMessages())));
        $this->setValidator('stock_message', new sfValidatorChoice(array('choices' => array_keys($this->getStockMessages()), 'required' => false)));

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

    public function getStockMessages() {
        ProjectConfiguration::getActive()->loadHelpers('I18N');
        return array(
            '' => '',
        __('out of stock') => __('out of stock'),
        __('on command') => __('on command')
        );
    }

    public function updateDefaultsFromObject()
    {
        // update defaults for the main object
        if ($this->isNew())
        {
            $this->setDefaults($this->getDefaults() + $this->getObject()->toArray(BasePeer::TYPE_FIELDNAME));
        }
        else
        {
            $this->setDefaults($this->getObject()->toArray(BasePeer::TYPE_FIELDNAME) + $this->getDefaults());
        }
        foreach(CategoryPeer::getFirstLevel() as $cat)
        {
            $this->getEmbeddedForm('product2_category_list')->setDefault((string) $cat, $this->getDefaultCategories($cat));
        }
    }

    public function getDefaultCategories(Category $category)
    {
        $defaults = array();
        $c = new Criteria;
        $c->add(CategoryPeer::PARENT_ID, $category->getId());
        foreach($this->getObject()->getProduct2CategorysJoinCategory($c) as $cat)
        {
            $defaults[] = $cat->getCategoryId();
        }
        return $defaults;
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
        $this->setValue('product2_category_list', self::array_flatten($this->getValue('product2_category_list')));
        parent::save($con);

        $this->postSaveThumbnail();

        return $this->getObject();
    }
}
