<h3><?php echo __('Forgot password step two') ?></h3>

<?php if ($sf_user->hasFlash('password_sent')): ?>
    <?php echo __('Your login and password have been sent to you email.') ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_forgotPasswordStepTwo'); ?>" method="post" class="form">
        <?php echo $form['email']->render(); ?>
        <table cellspacing="0" cellpadding="3">
            <tr>
                <td><?php echo __('Secret question') ?></td>
                <td><?php echo $secretQuestion; ?></td>
            <tr>
                <td><?php echo $form['secret_answer']->renderLabel(); ?></td>
                <td><?php echo $form['secret_answer']->render(); ?></td>
                <td><?php echo $form['secret_answer']->renderError(); ?></td>
            </tr>
            <tr><td colspan="2"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></td></tr>
        </table>
    </form>
<?php endif; ?>