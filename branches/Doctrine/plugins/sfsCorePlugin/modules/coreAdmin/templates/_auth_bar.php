<?php if ($sf_user->isAuthenticated()): ?>
    <?php echo __('Welcome, %username%', array('%username%' => $sf_user->getUserName())); ?>
    |
    <?php echo link_to(__('Logout'), '@administratorAdmin_logout'); ?>
<?php else: ?>
    <?php echo link_to(__('Login'), '@administratorAdmin_login'); ?>
<?php endif; ?>

