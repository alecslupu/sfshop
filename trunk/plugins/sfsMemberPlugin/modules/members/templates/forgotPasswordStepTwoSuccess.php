<h3><?php echo __('Forgot password step two') ?></h3>

<?php if ($sf_user->hasFlash('message')): ?>
    <?php echo __($sf_user->getFlash('message')) ?>
<?php else: ?>
    <form action="<?php echo url_for('@members_forgotPasswordStepTwo'); ?>" method="post" class="form">
        <div><b><?php echo __('Secret question') ?>:</b> <?php echo $secretQuestion; ?></div>
        <ul class="main">
            <?php echo $form ?>
            <li class="button"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
        </ul>
    </form>
<?php endif; ?>