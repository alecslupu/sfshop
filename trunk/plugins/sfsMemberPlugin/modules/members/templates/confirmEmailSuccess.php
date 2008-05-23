<h3><?php echo __('Confirm registration') ?></h3>

<?php if ($sf_user->hasFlash('message')): ?>
    <?php echo __($sf_user->getFlash('message')) ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_confirmRegistration'); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li class="button"><input type="submit" value="<?php echo __('Confirm') ?>" class="button"/></li>
        </ul>
    </form>
<?php endif; ?>