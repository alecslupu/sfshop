<h3><?php echo __('Sign in') ?></h3>

<form action="<?php echo url_for('@login'); ?>" method="post">
    <table cellspacing="0" cellpadding="3">
        <?php echo $form ?>
        <tr><td colspan="2"><input type="submit" value="<?php echo __('Login') ?>"/></td></tr>
    </table>
</form>