<?php use_helper('sfsAddressBook') ?>
<div id="container_info_delivery_address" class="container_info">
    <span class="caption"><?php echo __('Delivery address') ?></span>
    <span class="action">
        [ <?php echo link_to(__('Edit'), '#') ?> ]
    </span><br/><br/>
    <?php echo format_address($address, true, true) ?>
</div>
<div id="container_form_delivery_address" style="display: none">
    <h3><?php echo __('Edit delivery address') ?></h3>
    <?php include_component(
        'addressBook', 
        'inputForm', 
        array(
            'address' => $sf_data->getRaw('address'),
            'action'  => url_for('@addressBook_edit?id=' . $address->getId())
        )
    ) ?>
</div>
