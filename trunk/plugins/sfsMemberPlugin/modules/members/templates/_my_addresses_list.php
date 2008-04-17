<?php use_helper('Date') ?>

<table cellspacing="0" width="100%">
<thead>
<tr><th colspan="2">
    <?php include_partial('pager', array('pager' => $pager, 'action' => '@myAddressesList')); ?><br />
</th></tr>
<tr class="asset_table_bottom_border">
    <?php include_partial('my_addresses_list_th_tabular') ?>
</tr>
</thead>
<tfoot>
<tr><th colspan="2">
    <?php include_partial('pager', array('pager' => $pager, 'action' => '@myAddressesList')); ?><br />
</th></tr>
</tfoot>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $address): ?>
<?php $line_class = count($pager->getResults()) > $i ? 'asset_table_bottom_border' : ''?>
<tr class="<?php echo $line_class ?>">
    <?php include_partial('my_addresses_list_td_tabular', array('address' => $address)) ?>
    <?php include_partial('my_addresses_list_td_actions', array('address' => $address)) ?>
</tr>
<?php $i++; endforeach; ?>
</tbody>
</table>
