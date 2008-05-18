<?php if ($form->getObject()->isNew()): ?>
    <h3><?php echo __('Add new address') ?></h3>
    <?php $url = '@addressBook_add'; ?>
<?php else: ?>
    <h3><?php echo __('Edit address') ?></h3>
    <?php $url = '@addressBook_edit?id=' . $form->getObject()->getId(); ?>
<?php endif; ?>

<form action="<?php echo url_for($url); ?>" method="post" class="form">
    <ul class="main">
        <?php echo $form ?>
        <li class="button">
            <input type="submit" value="<?php echo __('Save') ?>" class="button"/>&nbsp;<input type="button" value="<?php echo __('Cancel') ?>" class="button" onclick="window.location='<?php echo $sf_request->getReferer() ?>'"/>
        </li>
    </ul>
</form>

