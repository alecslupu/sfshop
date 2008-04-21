<h3><?php echo __('Confirm registration') ?></h3>

<?php if ($sf_user->hasFlash('confirmed')): ?>
    <?php echo __('You are confirmed registration. Thanks!') ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_confirmRegistration'); ?>" method="post" class="form">
      <table cellspacing="0" cellpadding="2">
        <tr>
            <td><?php echo $form['confirm_code']->renderLabel(); ?></td>
            <td><?php echo $form['confirm_code']->render(); ?></td>
            <td><?php echo $form['confirm_code']->renderError(); ?></td>
        </tr>
        <tr><td colspan="2"><input type="submit" value="<?php echo __('Confirm') ?>" class="button"/></td></tr>
      </table>
    </form>
<?php endif; ?>
