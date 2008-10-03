<?php use_helper('recaptcha') ?>
<?php include_partial('core/container_header', array('caption' => __('Sign up'))) ?>
    <?php if ($sf_user->hasFlash('registered')): ?>
        <?php echo __('You are registered now. But you should to confirm your email. Please, check your email, the letter with instruction was sent to you.') ?>
    <?php else: ?>
        <form action="<?php echo url_for('@member_registration'); ?>" method="post" class="form" id="form_registration">
          <ul class="main">
              <?php echo $form ?>
              <li class="captcha">
                  <?php if (sfConfig::get('app_recaptcha_is_enabled', true)): ?>
                      <?php echo recaptcha_get_html(sfConfig::get('app_recaptcha_publickey'), $form['captcha']['response']->getError()); ?>
                  <?php endif; ?>
              </li>
              <li class="actions"><input type="submit" value="<?php echo __('Sign up') ?>" class="button"/></li>
          </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>

<?php if (!$sf_user->hasFlash('registered')): ?>
    <?php echo javascript_tag('
        observeFormFields("form_registration");
        highlightFieldsWithError("form_registration");
    ') ?>
<?php endif; ?>
