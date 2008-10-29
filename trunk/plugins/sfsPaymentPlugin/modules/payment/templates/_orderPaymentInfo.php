<div id="container_info_payment" class="container_info">
    <span class="caption"><?php echo __('Payment') ?></span>
    <span class="action">
        [ <?php echo link_to(__('Edit'), '#') ?> ]
    </span><br/><br/>
    <b><span class="service_title"><?php echo $paymentService->getTitle() ?></span></b>
    
    <?php $display = $paymentService->getIcon() ? '' : 'display: none' ?>
    
    <?php echo image_tag(sfConfig::get('app_icons_payment_web_dir') . '/' . $paymentService->getIcon(), array('style' => $display, 'class' => 'service_icon', 'align' => 'absmiddle')) ?><br/>
</div>
<div id="container_form_payment" style="display: none">
    <h3><?php echo __('Select payment method') ?></h3>
    <div class="container_form">
        <?php include_component('payment', 'selectForm') ?>
    </div>
</div>
