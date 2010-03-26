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
 * Brand form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BrandForm extends BaseBrandForm
{
    public function configure()
    {
        $this->setWidget('url', new sfWidgetFormInput(array(), array('size' => 80)));
        
        $this->setValidator('url', new sfValidatorUrl(
            array('required' => false),
            array('invalid'  => 'This is not a valid url')
        ));
        
        $this->embedThumbnailForm();
        $this->embedI18nForAllCultures();
    }
    
    public function embedThumbnailForm()
    {
        $thumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByThumbnailTypeName(ThumbnailPeer::ORIGINAL);
        $path = date('Y/m/d');
        $thumbnail = $this->object->getThumbnail(ThumbnailPeer::ORIGINAL);
        if(!$thumbnail || $thumbnail->getIsBlank())
        {
            $thumbnail = new Thumbnail();
            $thumbnail->setAssetId($this->object->getId());
            $thumbnail->setAssetTypeModel($this->getModelName());
            $thumbnail->setTtatId($thumbnailTypeAssetType->getId());
            $thumbnail->setPath(sfConfig::get('app_brand_thumbnails_dir_name','brand') . '/' . $path);
        }
        $thumbnailForm = new ThumbnailForm($thumbnail);
        $thumbnailForm->widgetSchema->setLabels(array('uuid' => false ));
        $this->embedForm('thumbnail', $thumbnailForm);
    }
    
    public function save($con = null)
    {
        $thumb_form = $this->getEmbeddedForm('thumbnail');
        if(isset($this->taintedValues['thumbnail']['uuid_delete'])) {
            ThumbnailPeer::deleteByAssetIdAndAssetTypeModel($thumb_form->getObject()->getAssetId(), 'Brand');
        }
        if( ! isset($this->taintedFiles['thumbnail']['uuid']['name'])
        or (isset($this->taintedFiles['thumbnail']['uuid']['name']) and ! $this->taintedFiles['thumbnail']['uuid']['name'])) {
            unset($this['thumbnail']);
        }
        parent::save($con);
        if(isset($this['thumbnail'])) {
            if($this->isNew()){
                // save again and update id
                $thumb_form->getObject()->setAssetId($this->getObject()->getId());
                parent::save($con);
            }
            ThumbnailPeer::updateThumbnails($this->getObject());
        }
        return $this->getObject();
    }
}
