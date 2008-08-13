<?php if ($option_type->isNew()): ?>
    Add new option
<?php else: ?>
    Edit option &ldquo; <?php echo $option_type->getTitle() ?> &rdquo;";
<?php endif; ?>