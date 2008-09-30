<?php use_helper('sfsCountryState') ?>
<?php echo javascript_tag(get_states_list_in_js()) ?>
<br/>
<h3><?php echo __('Address') ?></h3>
<form action="<?php echo url_for('@addressBook_addAddressForOrder'); ?>" method="post" id="form_address" name="form_address" class="form" onSubmit="return false">
    <ul class="main">
        
        <?php if (sfConfig::get('app_address_book_enabled', true)): ?>
            <?php if (isset($form['address_id'])): ?>
                <?php echo $form ?>
            <?php else: ?>
                <li><?php echo __('You dont have any address. Please use link bellow for add some address.') ?></li>
            <?php endif; ?>
            <li><?php echo link_to(__('Add new address'), '@addressBook_add'); ?></li>
        <?php else: ?>
            <?php echo $form ?>
        <?php endif; ?>
    </ul>
</form>
<?php  echo javascript_tag('
    var addressForm = new sfsForm(
        "form_address", 
        {
            nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '",
            postExecute: function()
            {
                if (this.isValid()) {
                    window.location = "' . url_for('@delivery_checkout') . '";
                }
            }
        });
') ?>

<?php if (!sfConfig::get('app_address_book_enabled', true)): ?>
    <?php echo javascript_tag('
        selCountry_onChange($F("address_country_id"));
        $("address_state_id").value = "' . $form->getDefault('state_id') . '"
    ') ?>
<?php endif; ?>