<?php if ($category->isNew()): ?>
    <?php echo __('Add new category') ?>
<?php else: ?>
    <?php echo __('Edit category &ldquo;%title%&rdquo;', array('%title%' => $category->getTitle())) ?>
<?php endif; ?>