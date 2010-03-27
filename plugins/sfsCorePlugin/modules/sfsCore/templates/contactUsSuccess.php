<?php include_partial('container_header', array('caption' => __('Contact Us', array(), 'sfsCorePlugin'))) ?>
<?php if ($sf_user->hasFlash('message')): ?>
  <?php echo __($sf_user->getFlash('message'), array(), 'sfsCorePlugin') ?>
<?php else: ?>
<form action="<?php echo url_for('@core_contactUs'); ?>" method="post" class="form">
  <ul class="main">
      <?php echo $form ?>
    <li class="actions">
      <input type="submit" value="<?php echo __('Send', array(), 'sfsCorePlugin') ?>" class="button"/>
    </li>
  </ul>
</form>
<?php endif; ?>
<?php include_partial('container_footer') ?>

