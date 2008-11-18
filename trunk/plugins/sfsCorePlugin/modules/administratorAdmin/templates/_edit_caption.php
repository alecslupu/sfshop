<?php if ($admin->isNew()): ?>
    <?php echo __('Add new admin') ?>
<?php else: ?>
    <?php echo __('Edit admin &ldquo;%title%&rdquo;', array('%title%' => $admin->getUsername())) ?>
<?php endif; ?>