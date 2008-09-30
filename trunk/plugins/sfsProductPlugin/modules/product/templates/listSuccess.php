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
<?php include_partial('list', array('action' => '@product_list', 'pager' => $pager,)) ?>
