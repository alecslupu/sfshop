<div style="padding-right: 10px; width: 230px">
    <h3><?php echo __('Categories') ?></h3>
    <?php echo drawCategoriesMenuTree($categories, @$parentTree, $currentCategoryId, $sf_request->getParameter('cPath'), $item_routing) ?>
</div>