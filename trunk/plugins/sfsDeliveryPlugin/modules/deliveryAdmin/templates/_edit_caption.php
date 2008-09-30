<?php if (!$delivery->isNew()): ?>
    <?php echo __('Edit delivery service &ldquo;%title%&rdquo;', array('%title%' => $delivery->getTitle())) ?>
<?php endif; ?>