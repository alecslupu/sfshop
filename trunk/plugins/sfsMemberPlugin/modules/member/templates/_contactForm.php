<form action="<?php echo url_for('@member_editContactInfo') ?>" method="post" class="form" id="form_member_contact" onsubmit="return false">
    <?php if ($error != ''): ?>
        <ul class="error">
            <li><?php echo $error ?></li>
        </ul>
    <?php endif; ?>
    <ul class="main">
        <?php echo $form ?>
        <li class="actions"><input type="submit" value="<?php echo __('Submit') ?>" class="button"> &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel"></li>
    </ul>
</form>