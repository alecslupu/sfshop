<h3><?php echo __('Registration') ?></h3>

<?php if ($sf_user->hasFlash('registered')): ?>
    <?php echo __('You are registered now. Thanks!') ?>
<?php else: ?>
    <form action="<?php echo url_for('@registration'); ?>" method="post">
      <table cellspacing="0" cellpadding="2">
        <?php //echo $form ?>
        <tr><td><b><?php echo __('Your Personal Details') ?></b></td></tr>
        <tr>
            <td><?php echo $form['gender']->renderLabel(); ?></td>
            <td><?php echo $form['gender']->render(); ?></td>
            <td><?php echo $form['gender']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $form['email']->renderLabel(); ?></td>
            <td><?php echo $form['email']->render(); ?></td>
            <td><?php echo $form['email']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $form['first_name']->renderLabel(); ?></td>
            <td><?php echo $form['first_name']->render(); ?></td>
            <td><?php echo $form['first_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $form['last_name']->renderLabel(); ?></td>
            <td><?php echo $form['last_name']->render(); ?></td>
            <td><?php echo $form['last_name']->renderError(); ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><b><?php echo __('Your Contact Information') ?></b></td></tr>
        <tr>
            <td><?php echo $form['phone']->renderLabel(); ?></td>
            <td><?php echo $form['phone']->render(); ?></td>
            <td><?php echo $form['phone']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $form['mobile_phone']->renderLabel(); ?></td>
            <td><?php echo $form['mobile_phone']->render(); ?></td>
            <td><?php echo $form['mobile_phone']->renderError(); ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><b><?php echo __('Your Password') ?></b></td></tr>
        <tr>
            <td><?php echo $form['password']->renderLabel(); ?></td>
            <td><?php echo $form['password']->render(); ?></td>
            <td><?php echo $form['password']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $form['confirm_password']->renderLabel(); ?></td>
            <td><?php echo $form['confirm_password']->render(); ?></td>
            <td><?php echo $form['confirm_password']->renderError(); ?></td>
        </tr>
        <tr><td><b><?php echo __('Your Address') ?></b></td></tr>
        <tr>
            <td><?php echo $form['address']['state']->renderLabel(); ?></td>
            <td><?php echo $form['address']['state']->render(); ?></td>
            <td><?php echo $form['address']['state']->renderError(); ?></td>
        </tr>
        <tr><td colspan="2"><input type="submit" value="<?php echo __('Register') ?>"/></td></tr>
      </table>
    </form>
<?php endif; ?>
