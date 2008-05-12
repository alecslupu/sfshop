<h3><?php echo __('Registration') ?></h3>

<?php if ($sf_user->hasFlash('registered')): ?>
    <?php echo __('You are registered now. Thanks!') ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_registration'); ?>" method="post" class="form">
      <ul class="main">
          <?php echo $form ?>
          <li class="button"><input type="submit" value="<?php echo __('Register') ?>" class="button"/></li>
      </ul>
    </form>
<?php endif; ?>
