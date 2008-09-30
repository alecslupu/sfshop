<h3><?php echo __('Payment') ?></h3>
<b><?php echo $paymentService->getTitle() ?></b>
<?php if ($paymentService->getIcon()): ?>
    <?php echo image_tag(sfConfig::get('app_icons_payment_web_dir') . '/' . $paymentService->getIcon(), array('align' => 'absmiddle')) ?>
<?php endif; ?>
<br/>
