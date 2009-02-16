<?php include_partial('core/container_header', array('caption' => __('Forgot password step two'))) ?>
    <?php if ($sf_user->hasFlash('restored')): ?>
        <?php echo __('Your login and password has been sent to your email.') ?>
    <?php else: ?>
        <form action="<?php echo url_for('@member_forgotPasswordStepTwo'); ?>" method="post" class="form forgot_password" id="form_forgot_password">
            <ul class="main">
                <li class="question"><?php echo $secretQuestion; ?></li>
                <?php echo $form ?>
                <li class="actions"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
            </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>
<?php echo javascript_tag('
    highlightFieldsWithError("form_forgot_password");
') ?>