<?php if ($language->isNew()): ?>
    <?php echo __('Add new language') ?>
<?php else: ?>
    <?php echo __('Edit language &ldquo;%title%&rdquo;', array('%title%' => $language->getTitleEnglish())) ?>
<?php endif; ?>