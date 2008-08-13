<?php use_helper('recaptcha') ?>
<?php include_partial('core/container_header', array('caption' => __('Registration'))) ?>
    <?php if ($sf_user->hasFlash('message')): ?>
        <?php echo __($sf_user->getFlash('message')) ?>
    <?php else: ?>
        <form action="<?php echo url_for('@member_registration'); ?>" method="post" class="form" id="registration">
          <ul class="main">
              <?php echo $form ?>
              <?php echo recaptcha_get_html(sfConfig::get('app_recaptcha_publickey'), $form['captcha']['response']->getError()); ?>
              <li class="button"><input type="submit" value="<?php echo __('Register') ?>" class="button"/></li>
          </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>
