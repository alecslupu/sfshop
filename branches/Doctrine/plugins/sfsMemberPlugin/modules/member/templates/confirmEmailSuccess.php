<?php include_partial('core/container_header', array('caption' => __('Confirm email'))) ?>
    <?php if ($sf_user->hasFlash('confirmed')): ?>
        <?php echo __('You are confirmed your email. Thanks!') ?>
    <?php else: ?>
        <form action="<?php echo url_for('@member_confirmRegistration'); ?>" method="post" class="form form_confirm">
            <ul class="main">
                <?php echo $form ?>
                <li class="actions"><input type="submit" value="<?php echo __('Confirm') ?>" class="button"/></li>
            </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>
