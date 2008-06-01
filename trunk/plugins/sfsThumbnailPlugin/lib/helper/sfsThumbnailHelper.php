<?php

function thumbnail_tag($thumbnail, $title)
{
    if ($thumbnail !== null) {
        return image_tag(
            $thumbnail->getUrl(), 
            array(
                'width'  => $thumbnail->getsfsThumbnailSize()->getWidth(),
                'height' => $thumbnail->getsfsThumbnailSize()->getHeight(),
                'title'  => $title
            )
        );
    }
    else {
        return __('No thumbnail avaliable');
    }
}
