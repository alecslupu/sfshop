<div id="container_info_member_contact" class="container_info">
    <span class="caption"><?php echo __('Contact info') ?></span>
    <span class="action">
        [ <?php echo link_to(__('Edit'), '#') ?> ]
    </span><br/><br/>
    <b><?php echo __('Primary phone') ?></b>: <span id="primary_phone"><?php echo $info['primary_phone'] ?></span><br/>
    <span id="content_secondary_phone" <?php echo $info['secondary_phone'] !='' ? '' : 'style="display: none"' ?>>
        <b><?php echo __('Secondary phone') ?></b>: <span id="secondary_phone"><?php echo $info['secondary_phone'] ?>
    </span><br/>
</div>
<div id="container_form_member_contact" class="container_info" style="display: none">
    <h3><?php echo __('Edit contact info') ?></h3>
    <div class="container_form">
        <?php include_component('member', 'contactForm', array('error' => $error)) ?>
    </div>
</div>