<?php use_helper('Date', 'sfsThumbnail'); ?>
<?php include_partial('core/container_header', array('caption' => $product->getTitle())) ?>
<div class="full_details">

    <div class="thumbnail">
        <?php
            $thumbnailMedium = $product->getThumbnail(ThumbnailPeer::MEDIUM);
            $thumbnailLarge = $product->getThumbnail(ThumbnailPeer::LARGE);
            echo thumbnail_lightbox_image_tag($thumbnailMedium, $thumbnailLarge, $product->getTitle());
        ?>
    </div>
    <div class="details">
            <b><?php echo $product->getTitle() ?></b><br/>
            <?php include_partial('brand/product_brand', array('product' => $product)) ?><br/>
            <b><?php echo __('Price') ?>:</b> <span class="price"><?php echo format_currency($product->getPrice()); ?></span><br/>
            <b><?php echo __('Description') ?>:</b><br/>
            <?php echo $product->getDescription(ESC_RAW) ?>
    </div>
</div>
<div><?php include_component('basket', 'addProductForm', array('product' => $product, 'optionsForm' => $optionsForm)); ?></div>
<?php include_partial('core/container_footer') ?>
