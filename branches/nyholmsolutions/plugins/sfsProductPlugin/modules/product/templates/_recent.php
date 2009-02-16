<?php use_helper('Date', 'sfsThumbnail'); ?>
<?php include_partial('core/container_header', array('caption' => __('Recent products'))) ?>

<?php $i = 0; foreach($products as $product): ?>
    <?php include_partial('product/list_tabular', array('product' => $product, 'i' => $i)); ?>
<?php $i++; endforeach; ?>

<?php if ($i < sfConfig::get('app_product_max_list', 10) && fmod($i, 2) == 1): ?>
    <div class="list_tabular right_colum"></div>
<?php endif; ?>

<?php include_partial('core/container_footer') ?>
