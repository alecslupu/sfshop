<?php include_partial('core/container_header', array('caption' => __('Forgot password step one'))) ?>
    <form action="<?php echo url_for('@member_forgotPasswordStepOne'); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li class="button"><input type="submit" value="<?php echo __('Send') ?>" class="button"/></li>
        </ul>
    </form>
<?php include_partial('core/container_footer') ?>