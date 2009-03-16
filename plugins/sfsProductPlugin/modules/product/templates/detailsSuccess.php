<?php use_helper('Date', 'sfsThumbnail'); ?>
<?php include_partial('core/container_header', array('caption' => $product->getTitle(ESC_RAW))) ?>
<div class="full_details">

    <div class="thumbnail">
        <?php
            $thumbnailMedium = $product->getThumbnail(ThumbnailPeer::MEDIUM);
            $thumbnailLarge = $product->getThumbnail(ThumbnailPeer::LARGE);
            echo thumbnail_lightbox_image_tag($thumbnailMedium, $thumbnailLarge, $product->getTitle());
        ?>
    </div>
    <div class="details">
            <span class="product_title"><?php echo $product->getTitle() ?></span><br/>
            <?php echo $product->getDescription(ESC_RAW) ?><br/>
            <?php include_partial('brand/product_brand', array('product' => $product)) ?><br/>
            <strong><?php echo __('Price') ?>:</strong> <span class="price"><?php echo format_currency($product->getProductPrice()); ?></span><br/>
            <div><?php include_component('basket', 'addProductForm', array('product' => $product, 'optionsForm' => $optionsForm)); ?></div>
    </div>
</div>
<?php include_partial('core/container_footer') ?>
