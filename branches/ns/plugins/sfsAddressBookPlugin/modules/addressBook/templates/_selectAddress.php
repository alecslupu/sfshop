<h3><?php echo __('Address') ?></h3>
<div id="container_select_address" <?php echo $hasAddresses ? '' : 'style="display: none"' ?>>
    <?php include_component('addressBook', 'selectForm') ?>
</div>

<?php if (!$hasAddresses): ?>
    <span id="notice"><b><?php echo __('You don\'t have any address in your address book. Please, enter your address details in form below.') ?></b></span>
<?php endif; ?>

<div id="container_edit_address" <?php echo $hasAddresses ? 'style="display: none"' : '' ?>>
    <div class="container_form">
        <?php include_component(
            'addressBook', 
            'inputForm', 
            array(
                'sufix'            => 'delivery',
                'is_shopping_cart' => true,
                'action'           => url_for('@addressBook_add?is_return_all_addresses=1')
            )) ?>
    </div>
</div>
<?php echo javascript_tag('
    var addressBookManage = new sfsAddressBookSelectManage(
        {form: "container_edit_address", info: "container_select_address"},
        {formId: "form_edit_delivery_address", formSelectId: "form_select_address"}
    );
') ?>

<?php if (!$hasAddresses): ?>
    <?php echo javascript_tag('
        addressBookManage.showForm(null, true);
    '); ?>
<?php endif; ?>
