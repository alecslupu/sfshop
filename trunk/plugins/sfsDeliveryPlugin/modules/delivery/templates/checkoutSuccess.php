<?php use_helper('sfsCurrency', 'sfsPayment'); ?>
<?php include_partial('core/container_header', array('caption' => __('Order delivery methods'))) ?>
    <form action="<?php echo url_for('@delivery_checkout'); ?>" method="post" class="form form_services">
        <ul>
            <?php echo $form; ?>
        </ul>
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td><?php echo button_to(__('Back'), '@basket_list', array('class' => 'button')) ?></td>
                <td align="right"><input type="submit" value="<?php echo __('Continue') ?>" class="button"></td>
            </tr>
        </table>
    </form>
<?php include_partial('core/container_footer') ?>