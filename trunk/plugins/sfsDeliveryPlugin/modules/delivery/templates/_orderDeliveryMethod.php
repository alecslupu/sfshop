<h3><?php echo __('Shipping') ?></h3>
<b><?php echo $sectionTitle ?></b> 
<?php if (isset($sectionIcon)): ?>
    <?php echo image_tag(sfConfig::get('app_icons_delivery_web_dir') . '/' . $sectionIcon) ?>
<?php endif; ?>
<br/>

<?php echo $methodTitle; ?>: <?php echo format_currency($methodPrice) ?>