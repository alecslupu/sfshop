<div id="container_form_contact" class="container_info" style="display: none">
    <?php include_component('member', 'contactForm', array('error' => $error)) ?>
</div>
<div id="container_info_contact" class="container_info">
    <span class="caption"><?php echo __('Contact info') ?></span>
    <span class="action">
        [ <?php echo link_to(__('Edit'), '#') ?> ]
    </span><br/><br/>
    <b><?php echo __('Primary phone') ?></b>: <span id="primary_phone"><?php echo $info['primary_phone'] ?></span><br/>
    <span id="content_secondary_phone" <?php echo $info['secondary_phone'] !='' ? '' : 'style="display: none"' ?>>
        <b><?php echo __('Secondary phone') ?></b>: <span id="secondary_phone"><?php echo $info['secondary_phone'] ?>
    </span><br/>
</div>

<?php if ($info['primary_phone'] == '' && $info['secondary_phone'] == ''): ?>
    <?php //echo javascript_tag('showEditForm("container_edit_contact", "container_contact_info")') ?>
<?php endif; ?>
