<?php if ($product->isNew()): ?>
    <?php echo __('Add new product') ?>
<?php else: ?>
    <?php echo __('Edit product &ldquo;%title%&rdquo;', array('%title%' => $product->getTitle())) ?>
<?php endif; ?>