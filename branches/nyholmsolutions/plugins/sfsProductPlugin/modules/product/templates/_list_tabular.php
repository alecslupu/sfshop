<?php if ($sf_request->hasParameter('path')): ?>
    <?php $path = $sf_request->getParameter('path') ?>
<?php else: ?>
    <?php
        list($product2category) = $product->getProduct2CategorysJoinCategory(); 
        if($product2category)
           $path = $product2category->getCategory()->getPath();
        else
           $path = '';
    ?>
<?php endif; ?>

<?php if (fmod($i, 2) == 0): ?>
    <?php $class = 'left_colum' ?>
<?php else: ?>
    <?php $class = 'right_colum' ?>
<?php endif; ?>
<div class="list_tabular <?php echo $class ?>">
    <div class="thumbnail">
        <?php $thumbnail = $product->getThumbnail(ThumbnailPeer::SMALL); ?>
        <?php echo link_to(
            thumbnail_tag(
                $thumbnail, 
                $product->getTitle()
            ), 
            '@product_details?path=' . generate_category_path_for_url($path) . '&id=' . $product->getId()
        ); ?>
    </div>
    <div class="details">
        <?php echo link_to(
            $product->getTitle(), 
            '@product_details?path=' . generate_category_path_for_url($path) . '&id=' . $product->getId(), 
            array('class' => 'product_title')
        ); ?><br/>
        <p><?php echo $product->getDescriptionShort(); ?></p>
        <strong><?php echo __('Price') ?>:</strong> <span class="price"><?php echo format_currency($product->getProductPrice()); ?></span><br/>
        <div style="line-height: 37px">
            <?php if (!$product->getHasOptions()): ?>
                <?php include_component('basket', 'addProductForm', array('product' => $product, 'isShortForm' => true)) ?>
            <?php else: ?>
                <?php echo link_to(__('Add to cart'), '@product_details?path=' . generate_category_path_for_url($path) . '&id=' . $product->getId(), array('class' => 'add_to_cart')) ?>
           <?php endif; ?>
        </div>
    </div>
</div>
