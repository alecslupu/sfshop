<?php if ($currency->isNew()): ?>
    <?php echo __('Add new currency') ?>
<?php else: ?>
    <?php echo __('Edit currency &ldquo;%title%&rdquo;', array('%title%' => $currency->getTitle())) ?>
<?php endif; ?>