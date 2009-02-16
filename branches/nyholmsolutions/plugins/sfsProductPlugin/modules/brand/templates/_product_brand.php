<?php $brand = $product->getBrand() ?>

<?php if ($brand !== null): ?>
    <b><?php echo __('Brand') ?>:</b> &nbsp;
    <?php if ($brand->getUrl()): ?>
        <?php echo link_to($brand->getTitle(), $brand->getUrl(), array('target' => '_blank')); ?>
    <?php else: ?>
        <?php echo $brand->getTitle() ?>
    <?php endif; ?>
<?php endif; ?>
