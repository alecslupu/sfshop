<?php use_helper('Date') ?>

<table cellspacing="1" width="100%" class="list">
<thead>
<?php if ($pager->haveToPaginate()): ?>
    <tr><th colspan="6">
        <?php include_partial('pager', array('pager' => $pager, 'action' => '@order_myList')); ?><br />
    </th></tr>
<?php endif; ?>
<tr>
    <?php include_partial('my_list_th_tabular') ?>
</tr>
</thead>
<tfoot>
<?php if ($pager->haveToPaginate()): ?>
    <tr><th colspan="6">
        <?php include_partial('pager', array('pager' => $pager, 'action' => '@order_myList')); ?><br />
    </th></tr>
<?php endif; ?>
</tfoot>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $order): $class = 'asset_table_bottom_border'; ?>
    
    <?php if ($pager->getNbResults() > 10 * $sf_request->getParameter('page') && $i == 10): ?>
         <?php $class = ''; ?>
    <?php elseif($pager->getNbResults() > 10 && 10 - ($sf_request->getParameter('page') * 10 - $pager->getNbResults()) == $i ): ?>
         <?php $class = ''; ?>
    <?php elseif($pager->getNbResults() == $i): ?>
         <?php $class = ''; ?>
    <?php endif; ?>
    
    <tr class="<?php echo $class ?>">
        <?php include_partial('my_list_td_tabular', array('order' => $order)) ?>
        <?php include_partial('my_list_td_actions', array('order' => $order)) ?>
    </tr>
<?php $i++; endforeach; ?>
</tbody>
</table>
