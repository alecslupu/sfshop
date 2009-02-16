<?php if ($option_value->isNew()): ?>
    Add new value
<?php else: ?>
    Edit value &ldquo; <?php echo $option_value->getTitle() ?> &rdquo;
<?php endif; ?>