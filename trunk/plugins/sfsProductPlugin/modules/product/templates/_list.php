<?php use_helper('Date', 'sfsThumbnail') ?>

<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>

<?php $i = 0; foreach ($pager->getResults() as $product): ?>
    <?php include_partial('list_tabular', array('product' => $product, 'i' => $i)) ?>
<?php $i++; endforeach; ?>

<?php if ($i < sfConfig::get('app_product_max_list', 10) && fmod($i, 2) == 1): ?>
    <div class="list_tabular right_colum"></div>
<?php endif; ?>

<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>

<?php  if ($pager->getNbResults() == 0 ): ?>
    <br/>
    <?php echo __('Category is empty'); ?>
    <br/><br/>
<?php endif; ?>

