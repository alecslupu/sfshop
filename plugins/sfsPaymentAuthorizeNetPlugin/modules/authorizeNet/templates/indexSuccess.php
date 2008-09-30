<?php include_partial('core/container_header', array('caption' => __('Pay through AuthorizeNet'))) ?>
    <form action="<?php echo url_for('@payment_authorizeNet?order_item_id=' . $sf_request->getParameter('order_item_id')) ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li><input type="submit" value="<?php echo __('Submit') ?>" class="button"></li>
        </ul>
    </form>
<?php include_partial('core/container_footer') ?>