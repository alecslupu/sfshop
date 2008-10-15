<?php /*
<div style="clear: both">
    <form action="<?php echo url_for('@product_list?path=' . $sf_request->getParameter('path')); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $form ?>
            <li class="button"><input type="submit" value="<?php echo __('Filter') ?>" class="button"/></li>
        </ul>
    </form>
</div>
 */ ?>

<?php if (isset($isSearch)): ?>
    <form action="<?php echo url_for('@product_search'); ?>" method="post" class="form">
        <ul class="main">
            <?php echo $formSearch ?>
            <li class="button"><input type="submit" value="<?php echo __('Search') ?>" class="button"/></li>
        </ul>
    </form>
    <?php $action = '@product_search' ?>
<?php else: ?>
    <?php $action = '@product_list' ?>
<?php endif; ?>

<?php include_partial('list', array('action' => $action, 'pager' => $pager,)) ?>
