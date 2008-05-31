<?php use_helper('Date') ?>
<?php include_component('categories', 'headerProductList'); ?>
<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>
<?php $i = 1; foreach ($pager->getResults() as $product): ?>
    <?php include_partial('list_tabular', array('product' => $product)) ?>
<?php $i++; endforeach; ?>

<div class="left_content_line">
    <div class="right_content_line">
        <div style="padding-left: 1px; padding-right: 1px"><div style="background: #d8d8d8; height: 10px;"></div></div>
        <div class="top_bottom_content_line"></div>
    </div>
</div>



<br/>
<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>
<div style="width: 100%; text-align: center">
    <?php  if ($pager->getNbResults() == 0 ) : ?>
        <?php echo __('category is empty'); ?>
        <br/><br/>
    <?php endif; ?>
</div>

