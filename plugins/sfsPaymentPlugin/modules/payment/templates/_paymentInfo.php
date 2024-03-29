<div id="container_info_payment" class="container_info">
    <span class="caption"><?php echo __('Payment') ?></span>
    <?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
        <span class="action">
            [ <?php echo link_to_function(__('Edit'), 'return false') ?> ]
        </span>
    <?php endif; ?>
    <br/><br/>
    <b><span class="service_title"><?php echo $paymentService['title'] ?></span></b>
    
    <?php $display = $paymentService['icon'] ? '' : 'display: none' ?>
    
    <?php echo image_tag(sfConfig::get('app_payment_icons_dir') . '/' . $paymentService['icon'], array('style' => $display, 'class' => 'service_icon', 'align' => 'absmiddle')) ?><br/>
    <span class="price" <?php echo $paymentService['price'] != '' ? '' : 'style="display: none"' ?>><?php echo format_currency($paymentService['price'],isset($paymentService['currency_id']) ? $paymentService['currency_id'] : null, false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></span>
</div>
<?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
    <div id="container_form_payment" style="display: none">
        <h3><?php echo __('Select payment method') ?></h3>
        <div class="container_form">
            <?php include_component('payment', 'selectForm') ?>
        </div>
    </div>
<?php endif; ?>