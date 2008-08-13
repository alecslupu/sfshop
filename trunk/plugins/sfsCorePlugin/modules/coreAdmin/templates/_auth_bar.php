<?php if ($sf_user->isAuthenticated()): ?>
    Welcome: <?php echo $sf_user->getUserName(); ?>
    |
    <?php echo link_to('Logout', '@coreAdmin_logout'); ?>
<?php else: ?>
    <?php echo link_to('Login', '@coreAdmin_login'); ?>
<?php endif; ?>

