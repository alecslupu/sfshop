<?php if ($brand->isNew()): ?>
    Add new brand
<?php else: ?>
    Edit brand &ldquo; <?php echo $brand->getTitle() ?> &rdquo;
<?php endif; ?>