<h3><?php echo __('Address') ?></h3>
<div id="container_select_address" <?php echo $hasAddresses ? '' : 'style="display: none"' ?>>
    <?php include_component('addressBook', 'selectForm') ?>
</div>
<div id="container_edit_address" <?php echo $hasAddresses ? 'style="display: none"' : '' ?>>
    <?php include_component('addressBook', 'inputForm', array('is_shopping_cart' => true)) ?>
</div>
