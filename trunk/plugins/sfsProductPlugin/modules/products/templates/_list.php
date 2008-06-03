<?php use_helper('Date', 'sfsThumbnail') ?>
<?php include_component('categories', 'headerProductList'); ?>
<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>

<?php foreach ($pager->getResults() as $product): ?>
    <?php include_partial('list_tabular', array('product' => $product)) ?>
<?php endforeach; ?>

<?php include_partial('pager', array('pager' => $pager, 'action' => $action)); ?>

<?php  if ($pager->getNbResults() == 0 ) : ?>
    <div class="left_content_line">
        <div class="right_content_line">
            <div style="margin-left: 1px; margin-right: 1px; padding-right: 20px; height: 50px; text-align: center; background: #f8f9f3">
                <br/>
                <?php echo __('Category is empty'); ?>
             </div>
            <div class="top_bottom_content_line"></div>
        </div>
    </div>
    
<?php endif; ?>

<div class="left_content_line">
    <div class="right_content_line">
        <div style="padding-left: 1px; padding-right: 1px"><div style="background: #d8d8d8; height: 10px;"></div></div>
        <div class="top_bottom_content_line"></div>
    </div>
</div>
