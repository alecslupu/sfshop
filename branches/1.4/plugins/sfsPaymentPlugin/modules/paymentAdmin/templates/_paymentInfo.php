<table cellspacing="0" cellpadding="0" class="sf_admin_list" style="width: 100%">
    <tr><th colspan="4"><?php echo __('Payment') ?></th></tr>
    <tr><td>
        <b><span class="service_title"><?php echo $paymentService->getTitle() ?></span></b>
        
        <?php $display = $paymentService->getIcon() ? '' : 'display: none' ?>
        
        <?php echo image_tag('http://' . sfContext::getInstance()->getRequest()->getHost() . '/images/' . sfConfig::get('app_payment_icons_dir') . '/' . $paymentService->getIcon(), array('style' => $display, 'class' => 'service_icon', 'align' => 'absmiddle')) ?><br/>
    </td></tr>
</table>
