<?php use_helper('sfsCountryState') ?>
<?php echo javascript_tag(get_states_list_in_js()) ?>
<form action="<?php echo $action; ?>" method="post" id="form_edit_address" name="form_edit_address" class="form" onSubmit="return false">
    <ul class="main">
        <?php echo $form ?>
        <li class="actions">
            <input type="submit" value="<?php echo __('Submit') ?>" class="button">
             &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel"></li>
    </ul>
</form>

<?php if (isset($is_shopping_cart)): ?>
    <?php $function = 'showSelectAddress(response.data)'; ?>
<?php else: ?>
    <?php $function = 'updateDeliveryInfo(response.data)'; ?>
<?php endif; ?>

<?php echo javascript_tag('

') ?>

<?php echo javascript_tag('
    $("address_country_id").observe("change", function(event) {
        selectCountry($F("address_country_id"));
    });
    
    selectCountry($F("address_country_id"));
    $("address_state_id").value = "' . $form->getDefault('state_id') . '"
    highlightFieldsWithError("form_edit_address");
') ?>
