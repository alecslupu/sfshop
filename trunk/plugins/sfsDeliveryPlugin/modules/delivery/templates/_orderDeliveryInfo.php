<div id="container_info_delivery" class="container_info">
    <span class="caption"><?php echo __('Shipping') ?></span>
    <?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
        <span class="action">
            [ <?php echo link_to(__('Edit'), '#') ?> ]
        </span>
    <?php endif; ?>
    <br/><br/>
    <b><span class="service_title"><?php echo $deliveryService->getTitle() ?></span></b>
    <?php $display = $deliveryService->getIcon() ? '' : 'display: none' ?>
    
    <?php echo image_tag(sfConfig::get('app_delivery_icons_dir') . '/' . $deliveryService->getIcon(), array('style' => $display, 'class' => 'service_icon', 'align' => 'absmiddle')) ?><br/>
    
    <span class="method_title" <?php echo $methodTitle != '' ? '' : 'style="display: none"' ?>><?php echo $methodTitle; ?>:</span>
    <span class="price"><?php echo format_currency($methodPrice) ?></span>
</div>
<?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
    <div id="container_form_delivery" style="display: none">
        <h3><?php echo __('Select shipping method') ?></h3>
        <div class="container_form">
            <?php include_component('delivery', 'selectForm') ?>
        </div>
    </div>
<?php endif; ?>