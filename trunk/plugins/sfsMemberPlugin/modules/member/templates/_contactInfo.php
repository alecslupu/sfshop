<div id="container_edit_contact"  class="container_info" style="display: none">
    <?php include_component('member', 'contactForm', array('error' => $error)) ?>
</div>
<div id="container_contact_info" class="container_info">
    <span class="caption"><?php echo __('Contact info') ?></span>
    <span class="action">
        [ <?php echo link_to_function(__('Edit'), 'showEditForm("container_edit_contact", "container_contact_info")') ?> ]
    </span><br/><br/>
    <?php if ($info['phone'] != ''): ?>
        <b><?php echo __('Phone') ?></b>: <span id="phone"><?php echo $info['phone'] ?></span><br/>
    <?php endif; ?>
    <?php if ($info['mobile'] != ''): ?>
        <b><?php echo __('Mobile') ?></b>: <span id="mobile"><?php echo $info['mobile'] ?></span><br/>
    <?php endif; ?>
</div>

<?php if ($info['phone'] == '' && $info['mobile'] == ''): ?>
    <?php echo javascript_tag('showEditForm("container_edit_contact", "container_contact_info")') ?>
<?php endif; ?>
