<form action="<?php echo url_for('@payment_authorizeNet?order_item_id=' . $sf_request->getParameter('order_item_id')) ?>" method="post" class="form" id="form_edit_card_info" onsubmit="return false">
    <?php if (count($errors) > 0): ?>
        <ul class="error">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <ul class="main">
        <?php echo $form ?>
        <li class="actions"><input type="submit" value="<?php echo __('Submit') ?>" class="button"> &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel"></li>
    </ul>
</form>