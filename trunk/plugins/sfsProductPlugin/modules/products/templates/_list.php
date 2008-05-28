<?php use_helper('Date') ?>

<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>
<br/>
<?php $i = 1; foreach ($pager->getResults() as $asset): ?>

<?php include_partial('list_tabular', array('asset' => $asset)) ?>

<?php $i++; endforeach; ?>
<br/>
<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>
<div style="width: 100%; text-align: center">
    <?php  if ($pager->getNbResults() == 0 ) : ?>
        <?php echo __('category is empty'); ?>
        <br/><br/>
    <?php endif; ?>
</div>

