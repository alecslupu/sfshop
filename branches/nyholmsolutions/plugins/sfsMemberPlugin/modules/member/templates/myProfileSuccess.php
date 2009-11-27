<?php include_partial('core/container_header', array('caption' => __('My profile'))) ?>
    <?php if ($sf_user->hasFlash('message')): ?>
        <div class="message"><?php echo __($sf_user->getFlash('message')) ?></div><br/>
    <?php endif; ?>
    <?php include_component('menu', 'profile') ?>
<?php include_partial('core/container_footer') ?>
