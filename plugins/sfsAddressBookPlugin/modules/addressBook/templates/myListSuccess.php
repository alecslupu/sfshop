<?php include_partial('core/container_header', array('caption' => __('My address book'))) ?>
    <?php if ($sf_user->hasFlash('message')): ?>
        <div class="message"><?php echo $sf_user->getFlash('message') ?></div><br/>
    <?php endif; ?>
    <?php if ($pager->getNbResults()): ?>
        <div>
            <?php include_partial('my_list', array('pager' => $pager)) ?>
        </div>
    <?php else: ?>
        <div style="width: 100%; text-align: center">
            <?php echo __('No addresses here. You can add new address using a link below.') ?>
            <br/>
        </div>
    <?php endif; ?>
    <br/>
    <div class="button_add_address">
        <?php echo link_to(
                image_tag('add.png', 
                    array('title' => __('Add address'), 'align' => 'absmiddle')
                ), '@addressBook_add'
            ) ?>&nbsp;
        <?php echo link_to(__('Add address'), '@addressBook_add') ?>
    </div>
    <br/>
<?php include_partial('core/container_footer') ?>
<?php echo javascript_tag('
    function confirmDeleteAddress(link)
    {
        return Dialog.confirm(
            "' . __('Are you sure want remove this address from your address book?') . '",
            {
                top: 180,
                width: 300,
                height: 80,
                className: "' . sfConfig::get('app_prototype_window_theme', 'sfshop') . '",
                okLabel: "' . __('Remove') . '",
                cancelLabel:"' . __('Don`t remove') . '",
                onOk: function() {
                    document.location = link;
                }
            }
        )
    }
') ?>