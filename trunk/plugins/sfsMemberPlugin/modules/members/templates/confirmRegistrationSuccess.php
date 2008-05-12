<h3><?php echo __('Confirm registration') ?></h3>

<?php if ($sf_user->hasFlash('confirmed')): ?>
    <?php echo __('You are confirmed registration. Thanks!') ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_confirmRegistration'); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li class="button"><input type="submit" value="<?php echo __('Register') ?>" class="button"/></li>
        </ul>
    </form>
<?php endif; ?>
