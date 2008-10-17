<?php use_helper('sfsCountryState') ?>
<br/>
<h3><?php echo __('Address') ?></h3>
<form action="<?php echo url_for('@addressBook_addAddressForOrder'); ?>" method="post" id="form_select_address" name="form_select_address" class="form" onSubmit="return false">
    <ul class="main" <?php echo $hasAddresses ? '' : 'style="display: none"' ?>>
        <?php echo $form ?>
    </ul>
</form>
<?php if (!$hasAddresses): ?>
    <?php echo __('You dont have any address. Please use link bellow for add some address.') ?>
<?php endif; ?>
<?php echo link_to_function(__('Add new address'), 'showEditForm("container_edit_address", "container_select_address")'); ?>

<?php  echo javascript_tag('
    var addressForm = new sfsForm(
        "form_select_address", 
        {
            nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '",
            postExecute: function()
            {
                if (this.isValid()) {
                    window.location = "' . url_for('@delivery_checkout') . '";
                }
            }
    });
    
    function showSelectAddress(data)
    {
        var element = $("form_select_address").down("select")
        element.innerHTML = "";
        
        $H(data.addresses).each(
            function(v) {
                var option = new Element("option", {"value": v.key}).update(v.value);
                element.insert(option);
            }
        );
        
        element.value = data.default_address_id;
        
        $("form_edit_address").getElements().each(
            function(element) {
                if (element.name != "address[first_name]" && element.name != "address[last_name]" && element.type != "submit" && element.type != "button") {
                    element.value = "";
                }
            }
        );
    }
') ?>