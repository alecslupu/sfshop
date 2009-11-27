<?php use_helper('sfsCountryState') ?>
<?php echo javascript_tag(get_states_list_in_js()) ?>
<form action="<?php echo $action; ?>" method="post" id="form_edit_<?php echo $sufix ?>_address" name="form_edit_address" class="form" onSubmit="return false">
    <ul class="main">
        <?php echo $form ?>
        <li class="actions">
            <input type="submit" value="<?php echo __('Submit') ?>" class="button">
             &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel">
        </li>
    </ul>
</form>

<?php echo javascript_tag('
    $("data_country_id").observe("change", function(event) {
        selectCountry($F("data_country_id"));
    });
    
    selectCountry($F("data_country_id"));
    $("data_state_id").value = "' . $form->getDefault('state_id') . '"
    highlightFieldsWithError("form_edit_' . $sufix . '_address");
') ?>
