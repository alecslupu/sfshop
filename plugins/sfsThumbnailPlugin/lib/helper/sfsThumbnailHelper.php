<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function thumbnail_tag($thumbnail, $title, $isAdminPart = false)
{
    if ($thumbnail !== null) {
        
        $prefix = '';
        
        if ($isAdminPart) {
            $prefix = 'http://' . sfContext::getInstance()->getRequest()->getHost() . '/images/';
        }
        $width = !$thumbnail->getThumbnailTypeAssetType()->getWidth() ? '' : $thumbnail->getThumbnailTypeAssetType()->getWidth();
        $height = !$thumbnail->getThumbnailTypeAssetType()->getHeight() ? '' : $thumbnail->getThumbnailTypeAssetType()->getHeight();
        return image_tag(
            $prefix . $thumbnail->getUrl(), 
            array(
                'alt_title'  => $title
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
            'alt_title'     => $title,
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