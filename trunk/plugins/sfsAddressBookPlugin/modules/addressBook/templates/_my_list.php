<?php use_helper('Date', 'sfsAddressBook') ?>

<table cellspacing="0" width="100%">
<thead>
<tr><th colspan="2">
    <?php include_partial('pager', array('pager' => $pager, 'action' => '@addressBook_myList')); ?><br />
</th></tr>
<tr class="asset_table_bottom_border">
    <?php include_partial('my_list_th_tabular') ?>
</tr>
</thead>
<tfoot>
<tr><th colspan="2">
    <?php include_partial('pager', array('pager' => $pager, 'action' => '@addressBook_myList')); ?><br />
</th></tr>
</tfoot>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $address): $class = 'asset_table_bottom_border'; ?>
    
    <?php if ($pager->getNbResults() > 10 * $sf_request->getParameter('page') && $i == 10): ?>
         <?php $class = ''; ?>
    <?php elseif($pager->getNbResults() > 10 && 10 - ($sf_request->getParameter('page') * 10 - $pager->getNbResults()) == $i ): ?>
         <?php $class = ''; ?>
    <?php elseif($pager->getNbResults() == $i): ?>
         <?php $class = ''; ?>
    <?php endif; ?>
    
    <tr class="<?php echo $class ?>">
        <?php include_partial('my_list_td_tabular', array('address' => $address)) ?>
        <?php include_partial('my_list_td_actions', array('address' => $address)) ?>
    </tr>
<?php $i++; endforeach; ?>
</tbody>
</table>
