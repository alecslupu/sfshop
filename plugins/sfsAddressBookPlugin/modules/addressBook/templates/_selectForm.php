<form action="<?php echo url_for('@addressBook_select'); ?>" method="post" id="form_select_address" name="form_select_address" class="form" onSubmit="return false">
    <ul class="main" <?php echo $hasAddresses ? '' : 'style="display: none"' ?>>
        <?php echo $form ?>
    </ul>
</form>
<?php if ($hasAddresses): ?>
    <?php slot('hasAddresses') ?>yes<?php end_slot() ?>
<?php endif; ?>

<?php echo link_to(__('Add new address'), '#', array('class' => 'action')); ?>

<?php echo javascript_tag('
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
') ?>