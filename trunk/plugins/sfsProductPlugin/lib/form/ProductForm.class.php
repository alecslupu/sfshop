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
        $this->embedI18nForAllCultures();
        sfProjectConfiguration::getActive()->loadHelpers('sfsCategory');

        unset(
            $this['id'],
            $this['created_at'],
            $this['updated_at'],
            $this['has_options'],
            $this['is_deleted']
        );

        $this->widgetSchema['thumbnail'] = new sfWidgetFormInputFile();
        $this->widgetSchema['product2_category_list'] = new sfWidgetFormChoice(array('multiple'=>true,'choices' => get_categories_tree_for_select(false)), array('size' => '10'));

        $this->widgetSchema['tax_type_id'] = new sfWidgetFormPropelChoice(array('model' => 'TaxType', 'peer_method' => 'getTaxRatesByName', 'add_empty' => true),array('onchange' => 'taxRateChanged()'));
        $this->widgetSchema['price'] = new sfWidgetFormInput(array('default' => $this->object->getNetPrice()),array('class' => 'product_price', 'onkeyup' => 'updateGrossPrice(\'product_price\')'));
        $this->widgetSchema['price_gross'] = new sfWidgetFormInput(array('default' => $this->object->getGrossPrice()),array('onkeyup' => 'updateNetPrice(\'product_price\')'));

        $this->validatorSchema['price'] = new sfValidatorNumber(array('required' => true)); //, 'culture' => sfContext::getInstance()->getUser()->getCulture()));
        $this->validatorSchema['weight'] = new sfValidatorNumber(array('required' => false)); //, 'culture' => sfContext::getInstance()->getUser()->getCulture()));
        $this->validatorSchema['quantity'] = new sfValidatorNumber(array('required' => false));

        $this->widgetSchema->setLabels(array(
            'is_active'         => 'Active?',
            'tax_type_id'       => 'Tax type',
            'price'             => 'Net price',
            'price_gross'       => 'Gross price',
            'allow_out_of_stock'       => 'Allow OS?',
            'product2_category_list' => 'Categories',
            'brand_id'          => 'Brand',
        ));

        $this->widgetSchema->setHelp('allow_out_of_stock', 'Allow user to order product if product is out of stock?');



        //        $this->widgetSchema['product2_category_list'] = new sfWidgetFormPropelChoiceMany(array('model' => 'Category', 'peer_method' => 'getTreeForChoice'));
        /*
        $opWrapperForm = new sfForm();
        foreach($this->object->getOptionProducts() as $optionproduct) {
        $opWrapperForm->embedForm($optionproduct->getId(), new OptionProductForm($optionproduct));
        }
         
        //$ops = new OptionProduct();
        $opWrapperForm->embedForm('new_op', new OptionTypeForm());
        $this->embedForm('option_product', $opWrapperForm);
        */
         
        $thumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByThumbnailTypeName(ThumbnailPeer::ORIGINAL);
        $path = date('Y/m/d');
        $thumbnail = $this->object->getThumbnail(ThumbnailPeer::ORIGINAL);
        //     echo $thumbnail->getId(); die;
        if(!$thumbnail || $thumbnail->getIsBlank())
        {
            $thumbnail = new Thumbnail();
            $thumbnail->setAssetId($this->object->getId());
            $thumbnail->setAssetTypeModel($this->getModelName());
            $thumbnail->setTtatId($thumbnailTypeAssetType->getId());
            $thumbnail->setPath(sfConfig::get('app_product_thumbnails_dir_name','products') . '/' . $path);
        }
        $thumbnailForm = new ThumbnailForm($thumbnail);
        $thumbnailForm->widgetSchema->setLabels(array('uuid' => false ));
        $this->embedForm('thumbnail', $thumbnailForm);
         
        
         
         
        $this->getValidatorSchema()->setOption('allow_extra_fields', true);


        $this->widgetSchema->moveField('thumbnail', sfWidgetFormSchema::FIRST);
        $this->widgetSchema->moveField('is_active', sfWidgetFormSchema::AFTER,'thumbnail');
        $this->widgetSchema->moveField('tax_type_id', sfWidgetFormSchema::AFTER,'is_active');
        $this->widgetSchema->moveField('price', sfWidgetFormSchema::AFTER,'tax_type_id');
        $this->widgetSchema->moveField('price_gross', sfWidgetFormSchema::AFTER,'price');
        $this->widgetSchema->moveField('quantity', sfWidgetFormSchema::AFTER,'price_gross');
        $this->widgetSchema->moveField('allow_out_of_stock', sfWidgetFormSchema::AFTER,'quantity');
        $this->widgetSchema->moveField('product2_category_list', sfWidgetFormSchema::AFTER,'allow_out_of_stock');

        $this->widgetSchema->moveField('weight', sfWidgetFormSchema::AFTER,'product2_category_list');
        $this->widgetSchema->moveField('cube', sfWidgetFormSchema::AFTER,'weight');
        $this->widgetSchema->moveField('brand_id', sfWidgetFormSchema::AFTER,'cube');
         
         
         
        if(!sfConfig::get('app_tax_is_enabled',false)) {
            unset($this['tax_type_id']);
            unset($this['price_gross']);
        }
         
    }


    public function save($con = null)
    {
        if(isset($this->taintedValues['thumbnail']['uuid_delete'])) {
            $embed = $this->getEmbeddedForms();
            ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($embed['thumbnail']->getObject()->getAssetId(), 'Product');
            //          unset($this['thumbnail']); test this
        }
        if(!$this->taintedFiles['thumbnail']['uuid']['name']) {
            unset($this['thumbnail']);
        }

        parent::save($con);
        if(isset($this['thumbnail'])) {
            if($this->isNew()){
                // save again and update id
                $embed = $this->getEmbeddedForms();
                $embed['thumbnail']->getObject()->setAssetId($this->object->getId());
                parent::save($con);
            }
            ThumbnailPeer::updateThumbnails($this->object);
        }
        return $this->object;
    }

}
