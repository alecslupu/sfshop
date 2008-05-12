<h3><?php echo __('My address book') ?></h3>

<div>
    <?php include_partial('my_addresses_list', array('pager' => $pager)) ?>
</div>
<div style="float: right"><?php echo link_to(__('Add address'), '@addressBook_addAddress') ?></div>
<br/>