<?php include_partial('core/container_header', array('caption' => __('Contact Us'))) ?>
    <?php if ($sf_user->hasFlash('message')): ?>
       <?php echo __($sf_user->getFlash('message')) ?>
    <?php else: ?>
        <form action="<?php echo url_for('@core_contactUs'); ?>" method="post" class="form">
            <ul class="main">
                <?php echo $form ?>
                <li class="button"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
            </ul>
        </form>
    <?php endif; ?>
<?php include_partial('core/container_footer') ?>

