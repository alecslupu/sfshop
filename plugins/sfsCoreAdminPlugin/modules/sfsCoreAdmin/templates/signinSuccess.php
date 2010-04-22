<?php use_helper("I18N")?>
<div class="box" id="signin">
  <center>
    <img src="/sfsCoreAdminPlugin/images/logo.gif" />
  </center>
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <?php echo $form->renderHiddenFields(); ?>
    <fieldset>
      <legend><?php echo __('Sign in') ?></legend>

      <?php if ($form['username']->hasError()):?>
          <div class="notification error png_bg">
            <a href="#" class="close"><img src="/sfsCoreAdminPlugin/images/icons/cross_grey_small.png" title="<?php __('Close this notification')?>" alt="<?php __('Close this notification')?>" /></a>
            <div>
              <?php echo $form['username']->getError();?>
            </div>
          </div>
      <?php endif; ?>

      <table class="nostyle">
        <tr>
          <td><?php echo $form['username']->renderLabel()?>:</td>
          <td><?php echo $form['username']->render(array('class'=>"input-text"));?></td>
        </tr>
        <tr>
          <td><?php echo $form['password']->renderLabel()?>:</td>
          <td><?php echo $form['password']->render(array('class'=>"input-text"));?></td>
        </tr>
        <?php echo $form['remember']->renderRow();?>
        </table>
    </fieldset>

    <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a>
    <input type="submit"class="input-submit" value="<?php echo __('sign in') ?>" />
    
  </form>
</div>
