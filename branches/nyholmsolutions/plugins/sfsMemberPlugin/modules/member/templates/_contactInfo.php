<div id="container_info_member_contact" class="container_info">
    <span class="caption"><?php echo __('Contact info') ?></span>
    <?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
    <span class="action">
        [ <?php echo link_to_function(__('Edit'), 'return false') ?> ]
    </span>
    <?php endif; ?>
    <br/><br/>
    <b><?php echo __('Primary phone') ?></b>: <span id="primary_phone"><?php echo $contactInfo['primary_phone'] ?></span><br/>
    <span id="content_secondary_phone" <?php echo $contactInfo['secondary_phone'] !='' ? '' : 'style="display: none"' ?>>
        <b><?php echo __('Secondary phone') ?></b>: <span id="secondary_phone"><?php echo $contactInfo['secondary_phone'] ?>
    </span></span><br/>
    <b><?php echo __('Email') ?></b>: <span id="email"><?php echo $contactInfo['email'] ?></span><br/>
</div>
<?php if (isset($is_edit_enabled) && $is_edit_enabled ): ?>
<div id="container_form_member_contact" class="container_info" style="display: none">
    <h3><?php echo __('Edit contact info') ?></h3>
    <div class="container_form">
        <?php include_component('member', 'contactForm', array('error' => $error)) ?>
    </div>
</div>
<?php endif; ?>