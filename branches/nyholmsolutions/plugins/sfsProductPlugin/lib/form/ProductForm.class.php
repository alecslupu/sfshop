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
      sfProjectConfiguration::getActive()->loadHelpers('sfsCategory');
      unset(
        $this['id'],
        $this['created_at'],
        $this['updated_at'],
        $this['has_options'],
        $this['is_deleted']
     );
     if(!sfConfig::get('app_tax_is_enabled',false))
        unset($this['tax_type_id']);

        $this->widgetSchema['thumbnail'] = new sfWidgetFormInputFile();
        $this->widgetSchema['product2_category_list'] = new sfWidgetFormChoiceMany(array('choices' => get_categories_tree_for_select(false)));
//        $this->widgetSchema['product2_category_list'] = new sfWidgetFormPropelChoiceMany(array('model' => 'Category', 'peer_method' => 'getTreeForChoice'));
/*
     $opWrapperForm = new sfForm();
     foreach($this->object->getOptionProducts() as $optionproduct) {
         $opWrapperForm->embedForm($optionproduct->getId(), new OptionProductForm($optionproduct));
     }
     
     //$ops = new OptionProduct();
     $opWrapperForm->embedForm('new_op', new OptionProductForm());
     $this->embedForm('option_product', $opWrapperForm);
*/
     $thumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByThumbnailTypeName(ThumbnailPeer::ORIGINAL);
     $path = date('Y/m/d');
     $thumbnail = $this->object->getThumbnail(ThumbnailPeer::ORIGINAL); //SMALL
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
     $this->embedForm('thumbnail', $thumbnailForm);

     $this->embedI18nForAllCultures(); 
     $this->getValidatorSchema()->setOption('allow_extra_fields', true);
  }

  public function unsetThumbnail()
  {
      unset($this['thumbnail']);
  }

 public function save($con = null)
  {
    parent::save($con);
    ThumbnailPeer::updateThumbnails($this->object);
    return $this->object;
  }
    
}
