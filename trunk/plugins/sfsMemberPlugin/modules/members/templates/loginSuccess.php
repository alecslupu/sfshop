<h3><?php echo __('Sign in') ?></h3>

<form action="<?php echo url_for('@members_login'); ?>" method="post" class="form">
    <ul class="main">
        <?php echo $form ?>
        <li class="button"><input type="submit" value="<?php echo __('Login') ?>" class="button"/></li>
    </ul>
</form>