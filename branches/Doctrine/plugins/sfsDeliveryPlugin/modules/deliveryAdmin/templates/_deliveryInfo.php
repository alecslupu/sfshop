<table cellspacing="0" cellpadding="0" width="100%" class="sf_admin_list" style="width: 100%">
    <tr><th colspan="4"><?php echo __('Shipping') ?></th></tr>
    <tr><td>
        <b><span class="service_title"><?php echo $deliveryService->getTitle() ?></span></b>
        <?php $display = $deliveryService->getIcon() ? '' : 'display: none' ?>
        <?php echo image_tag('http://' . sfContext::getInstance()->getRequest()->getHost() . '/images/' . sfConfig::get('app_delivery_icons_dir') . '/' . $deliveryService->getIcon(), array('style' => $display, 'class' => 'service_icon', 'align' => 'absmiddle')) ?><br/>
        <span class="method_title" <?php echo $method_title != '' ? '' : 'style="display: none"' ?>><?php echo $method_title; ?>:</span>
        <span class="price"><?php echo format_currency($method_price) ?></span>
    </td></tr>
</table>
