<h3><?php echo __('Shipping') ?></h3>
<b><?php echo $deliveryService->getTitle() ?></b> 
<?php if (isset($sectionIcon)): ?>
    <?php echo image_tag(sfConfig::get('app_icons_delivery_web_dir') . '/' . $deliveryMethod->getIcon()) ?>
<?php endif; ?>
<?php if (isset($methodSubTitle) && $methodSubTitle !=''): ?>
    <br/>
    <?php echo $methodSubTitle; ?>: <?php echo format_currency($methodPrice) ?>
<?php else: ?>
    : <?php echo format_currency($methodPrice) ?>
<?php endif; ?>