<h3><?php echo __('Forgot password step one') ?></h3>

<form action="<?php echo url_for('@members_forgotPasswordStepOne'); ?>" method="post" class="form">
    <ul class="main">
        <?php echo $form ?>
        <li class="button"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
    </ul>
</form>