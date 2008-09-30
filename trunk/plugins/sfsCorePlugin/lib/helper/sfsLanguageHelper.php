<?php
function language_icon($language)
{ 
    if ($language !== null) {
        return image_tag(
            sfConfig::get('languages_images_dir', 'languages') 
            . '/'
            . strtolower($language->getNameEnglish()) 
            . '/'
            . 'icon.png',
            array(
                'title' => $language->getNameOwn(),
                'align' => 'absmiddle'
            )
        );
    } 
}
?>