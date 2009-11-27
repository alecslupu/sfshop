<form action="<?php echo url_for('@payment_checkout'); ?>" method="post" class="form form_services form_payment_services" id="form_payment" onSubmit="return false">
    <ul class="services_list">
        <li class="row">
            <ul class="methods_list">
                <?php $radios = $form['method_id']->render(); ?>
                <li class="row"><?php echo $form['method_id']->renderError() ?></li>
                <?php $i = 0; foreach ($paymentServices as $paymentService): ?>
                    <li class="label">
                        <?php echo $radios[$i]['label'] ?>
                        <?php if($paymentService->getIcon()):?>
                          <?php echo image_tag(sfConfig::get('app_payment_icons_dir') . '/' . $paymentService->getIcon(), array('align' => 'absmiddle')); ?>
                        <?php endif;?>
                    </li>
                    <li><?php echo $radios[$i]['input'] ?>
                <?php $i++; endforeach; ?>
            </ul>
        </li>
        <li class="actions">
            <input type="submit" value="<?php echo __('Submit') ?>" class="button">
             &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel">
        </li>
    </ul>
</form>
