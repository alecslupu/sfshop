<?php include_partial('core/container_header', array('caption' => __('Order payment methods'))) ?>
    <form action="<?php echo url_for('@payment_checkout'); ?>" method="post" class="form form_services form_payment_services">
        <ul class="methods_list">
            <?php $radios = $form['method_id']->render(); ?>
            <li class="row"><?php echo $form['method_id']->renderError() ?></li>
            <?php $i = 0; foreach ($paymentServices as $paymentService): ?>
                <li class="label">
                    <?php echo $radios[$i]['label'] ?>
                    <?php echo image_tag(sfConfig::get('app_payment_icons_dir') . '/' . $paymentService->getIcon(), array('align' => 'absmiddle')); ?>
                </li>
                <li class="price">&nbsp;
                <?php if(isset($method['price'])):?>
                  <?php echo format_currency($method['price']) ?>
                <?php endif; ?>
                </li>
                <li><?php echo $radios[$i]['input'] ?></li>
            <?php $i++; endforeach; ?>
        </ul>
        <table cellspacing="0" cellpadding="0" width="100%" style="clear: both">
            <tr>
                <td><?php echo button_to(__('Back'), '@delivery_checkout', array('class' => 'button')) ?></td>
                <td align="right"><input type="submit" value="<?php echo __('Continue') ?>" class="button"></td>
            </tr>
        </table>
    </form>
<?php include_partial('core/container_footer') ?>