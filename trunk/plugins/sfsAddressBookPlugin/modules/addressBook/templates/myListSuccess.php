<h3><?php echo __('My address book') ?></h3>

<?php if ($pager->getNbResults()): ?>
    <div>
        <?php include_partial('my_list', array('pager' => $pager)) ?>
    </div>
<?php else: ?>
    <div style="width: 100%; text-align: center">
        <?php echo __('no results') ?>
        <br/>
    </div>
<?php endif; ?>

<div style="float: right">
    <?php echo link_to(
            image_tag('add.png', 
                array('title' => __('Add address'), 'align' => 'absmiddle')
            ), '@addressBook_add'
        ) ?>&nbsp;
    <?php echo link_to(__('Add address'), '@addressBook_add') ?>
</div>
<br/>