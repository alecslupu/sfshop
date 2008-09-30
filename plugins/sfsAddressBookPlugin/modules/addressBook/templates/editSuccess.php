<?php use_helper('sfsCountryState') ?>
<?php echo javascript_tag(get_states_list_in_js()) ?>

<?php if ($form->getObject()->isNew()): ?>
    <?php $caption = 'Add new address'; ?>
    <?php $url = '@addressBook_add'; ?>
<?php else: ?>
    <?php $caption = 'Edit address'; ?>
    <?php $url = '@addressBook_edit?id=' . $form->getObject()->getId(); ?>
<?php endif; ?>

<?php include_partial('core/container_header', array('caption' => __($caption))) ?>
    <form action="<?php echo url_for($url); ?>" method="post" id="form" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li>
                <input type="submit" value="<?php echo __('Save') ?>" class="button"/>&nbsp;<input type="button" value="<?php echo __('Cancel') ?>" class="button" onclick="window.location='<?php echo $sf_request->getReferer() ?>'"/>
            </li>
        </ul>
    </form>
<?php include_partial('core/container_footer') ?>
<?php if ($sf_request->hasParameter('address[state_id]')): ?>
    <?php $stateId = $sf_request->getParameter('address[state_id]') ?>
<?php else: ?>
    <?php $stateId = $form->getDefault('state_id') ?>
<?php endif; ?>
    
<?php echo javascript_tag('
    setCheckboxValue();
    selCountry_onChange($F("address_country_id"));
    $("address_state_id").value = "' . $stateId . '";
') ?>
