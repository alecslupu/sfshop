<div class="box" id="signin">
  <center>
    <a href="http://www.sfshop.net/" target="blank" title="<?php echo __('sfShop website', array(), 'sfsCoreAdminPlugin');?>">
      <img src="/sfsCoreAdminPlugin/images/logo.gif"  alt="<?php echo __('sfShop', array(), 'sfsCoreAdminPlugin');?>" title="<?php echo __('Visit Site', array(), 'sfsCoreAdminPlugin')?>"/>
    </a>
  </center>
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <?php echo $form->renderHiddenFields(); ?>
    <fieldset>
      <legend><?php echo __('Sign in', array(), 'sfsCoreAdminPlugin') ?></legend>

      <?php if ($form['username']->hasError()):?>
          <div class="notification error png_bg">
            <a href="#" class="close"><img src="/sfsCoreAdminPlugin/images/icons/cross_grey_small.png" title="<?php __('Close this notification')?>" alt="<?php __('Close this notification', array(), 'sfsCoreAdminPlugin')?>" /></a>
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

    <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?', array(), 'sfsCoreAdminPlugin') ?></a>
    <input type="submit"class="input-submit" value="<?php echo __('sign in', array(), 'sfsCoreAdminPlugin') ?>" />
    
  </form>
</div>
