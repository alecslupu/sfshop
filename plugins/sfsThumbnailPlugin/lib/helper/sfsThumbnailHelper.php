<?php

function thumbnail_tag($thumbnail, $title, $isAdminPart = false)
{
    if ($thumbnail !== null) {
        
        $prefix = '';
        
        if ($isAdminPart) {
            $prefix = 'http://' . sfContext::getInstance()->getRequest()->getHost() . '/images/';
        }
        
        return image_tag(
            $prefix . $thumbnail->getUrl(), 
            array(
                'width'  => $thumbnail->getThumbnailTypeAssetType()->getWidth(),
                'height' => $thumbnail->getThumbnailTypeAssetType()->getHeight(),
                'title'  => $title
            )
        );
    }
    else {
        return __('No thumbnail avaliable');
    }
}

function thumbnail_lightbox_image_tag($thumbnailMedium, $thumbnailLarge, $title)
{
    use_helper('Lightbox');
    
    if ($thumbnailMedium !== null && $thumbnailLarge !== null) {
        
        $images = array();
        $images[] = array(
            'thumbnail' => $thumbnailMedium->getUrl(),
            'image'     => '/images/' . $thumbnailLarge->getUrl(),
            'options'   => array()
        );
        
        $linkOptions = array(
            'title'     => $title,
            'slidename' => 'lightbox',
            'style'     => 'padding-left: 5px'
        );
        
        return light_slideshow($images, $linkOptions);
    }
}

function thumbnail_lightbox_text_tag($text, $thumbnailLarge)
{
    use_helper('Lightbox');
    
    if ($text !== null && $thumbnailLarge !== null) {
        return light_image($text, '/images/' . $thumbnailLarge->getUrl(), array(), array());
    }
}