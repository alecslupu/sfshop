<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function language_icon($language)
{ 
    if ($language !== null) {
        return image_tag(
            sfConfig::get('languages_images_dir', 'languages') 
            . '/'
            . strtolower($language->getTitleEnglish()) 
            . '/'
            . 'icon.png',
            array(
                'title' => $language->getTitleOwn(),
                'alt'   => $language->getTitleOwn(),
                'align' => 'absmiddle'
            )
        );
    } 
}
?>