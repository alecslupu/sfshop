<?php include_partial('core/container_header', array('caption' => __('Sign in'))) ?>
    <form action="<?php echo url_for('@member_login'); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li><input type="submit" value="<?php echo __('Login') ?>" class="button"></li>
        </ul>
    </form>
<?php include_partial('core/container_footer') ?>
