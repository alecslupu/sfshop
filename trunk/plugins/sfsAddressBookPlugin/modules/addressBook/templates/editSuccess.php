<?php if ($form->getObject()->isNew()): ?>
    <h3><?php echo __('Add new address') ?></h3>
    <?php $url = '@addressBook_addAddress'; ?>
<?php else: ?>
    <h3><?php echo __('Edit address') ?></h3>
    <?php $url = '@addressBook_editAddress?id=' . $form->getObject()->getId(); ?>
<?php endif; ?>

<form action="<?php echo url_for($url); ?>" method="post" class="form">
    <ul>
        <?php echo $form ?>
        <li><input type="submit" value="<?php echo __('Save') ?>" class="button"/></li>
    </ul>
</form>

