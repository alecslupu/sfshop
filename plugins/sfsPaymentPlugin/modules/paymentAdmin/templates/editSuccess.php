<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'AdvancedAdmin') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo include_partial('edit_caption', array('payment' => $payment)) ?></h1>

<div id="sf_admin_header">
<?php include_partial('paymentAdmin/edit_header', array('payment' => $payment)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('paymentAdmin/edit_messages', array('payment' => $payment, 'form' => $form, 'labels' => $labels)) ?>
<?php include_partial('paymentAdmin/edit_form', array('payment' => $payment, 'form' => $form)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('paymentAdmin/edit_footer', array('payment' => $payment)) ?>
</div>

</div>
