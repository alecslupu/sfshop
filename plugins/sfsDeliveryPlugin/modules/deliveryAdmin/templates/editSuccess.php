<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'AdvancedAdmin') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo include_partial('edit_caption', array('delivery' => $delivery)) ?></h1>

<div id="sf_admin_header">
<?php include_partial('deliveryAdmin/edit_header', array('delivery' => $delivery)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('deliveryAdmin/edit_messages', array('delivery' => $delivery, 'form' => $form, 'labels' => $labels)) ?>
<?php include_partial('deliveryAdmin/edit_form', array('delivery' => $delivery, 'form' => $form)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('deliveryAdmin/edit_footer', array('delivery' => $delivery)) ?>
</div>

</div>
