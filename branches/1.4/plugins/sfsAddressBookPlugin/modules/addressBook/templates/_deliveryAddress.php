<?php use_helper('sfsAddressBook') ?>
<div id="container_info_delivery_address" class="container_info">
    <span class="caption"><?php echo __('Delivery address') ?></span>
    <?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
        <span class="action">
            [ <?php echo link_to_function(__('Edit'), 'return false') ?> ]
        </span>
    <?php endif; ?>
    <br/><br/>
    <?php echo format_address($sf_data->getRaw('address'), true, true) ?>
</div>
<?php if (isset($is_edit_enabled) && $is_edit_enabled): ?>
    <div id="container_form_delivery_address" style="display: none">
        <h3><?php echo __('Edit delivery address') ?></h3>
        <div class="container_form">
            <?php include_component(
                'addressBook', 
                'inputForm', 
                array(
                    'sufix'   => 'delivery',
                    'address' => $sf_data->getRaw('address'),
                    'action'  => url_for('@addressBook_edit?id=' . $address->getId())
                )
            ) ?>
        </form>
    </div>
<?php endif; ?>