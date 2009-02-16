<?php if ($sf_user->isAuthenticated()): ?>
    Welcome: <?php echo $sf_user->getUserName(); ?>
    |
    <?php echo link_to('Logout', '@administratorAdmin_logout'); ?>
<?php else: ?>
    <?php echo link_to('Login', '@administratorAdmin_login'); ?>
<?php endif; ?>

