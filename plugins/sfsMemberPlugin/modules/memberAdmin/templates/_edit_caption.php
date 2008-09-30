<?php if ($member->isNew()): ?>
    <?php echo __('Add new member') ?>
<?php else: ?>
    <?php echo __('Edit member &ldquo;%title%&rdquo;', array('%title%' => $member->getFirstName() . ' ' . $member->getLastName())) ?>
<?php endif; ?>