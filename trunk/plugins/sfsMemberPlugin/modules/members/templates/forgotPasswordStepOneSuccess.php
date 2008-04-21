<h3><?php echo __('Forgot password step one') ?></h3>

<form action="<?php echo url_for('@members_forgotPasswordStepOne'); ?>" method="post" class="form">
    <table cellspacing="0" cellpadding="3">
        <tr>
            <td><?php echo $form['email']->renderLabel(); ?></td>
            <td><?php echo $form['email']->render(); ?></td>
            <td><?php echo $form['email']->renderError(); ?></td>
        </tr>
        <tr><td colspan="2"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></td></tr>
    </table>
</form>