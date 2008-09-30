<?php if ($information->isNew()): ?>
    <?php echo __('Add new page') ?>
<?php else: ?>
    <?php echo __('Edit page &ldquo;%title%&rdquo;', array('%title%' => $information->getTitle())) ?>
<?php endif; ?>