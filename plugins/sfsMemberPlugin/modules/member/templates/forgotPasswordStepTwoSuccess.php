<?php include_partial('core/container_header', array('caption' => __('Forgot password step two'))) ?>
    <?php if ($sf_user->hasFlash('message')): ?>
        <?php echo __($sf_user->getFlash('message')) ?>
    <?php else: ?>
        <form action="<?php echo url_for('@member_forgotPasswordStepTwo'); ?>" method="post" class="form">
            <b><?php echo __('Secret question') ?>:</b> <?php echo $secretQuestion; ?><br/>
            <ul class="main">
                <?php echo $form ?>
                <li class="button"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
            </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>