<?php if (!$payment->isNew()): ?>
    <?php echo __('Edit payment service &ldquo;%title%&rdquo;', array('%title%' => $payment->getTitle())) ?>
<?php endif; ?>