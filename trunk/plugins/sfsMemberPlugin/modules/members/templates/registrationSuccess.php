<h3><?php echo __('Registration') ?></h3>

<?php if ($sf_user->hasFlash('registered')): ?>
    <?php echo __('You are registered now. Thanks!') ?>
<?php else: ?>
    <form action="<?php echo url_for('@registration'); ?>" method="post">
      <table cellspacing="0" cellpadding="3">
        <?php echo $form ?>
        <tr><td colspan="2"><input type="submit" value="<?php echo __('Register') ?>"/></td></tr>
      </table>
    </form>
<?php endif; ?>
