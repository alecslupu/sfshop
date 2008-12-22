<?php use_helper('sfsAddressBook') ?>
<div id="container_info_billing_address" class="container_info">
    <span class="caption"><?php echo __('Billing address') ?></span>
    <span class="action">
        [ <?php echo link_to_function(__('Edit'), 'return false') ?> ]
    </span><br/><br/>
    <?php echo format_address($address, true, true) ?>
</div>
<div id="container_form_billing_address" style="display: none">
    <h3><?php echo __('Edit billing address') ?></h3>
    <div class="container_form">
        <?php include_component(
            'addressBook', 
            'inputForm', 
            array(
                'sufix'   => 'billing',
                'address' => $sf_data->getRaw('address'),
                'action'  => url_for('@addressBook_add')
            )
        ) ?>
    </form>
</div>
