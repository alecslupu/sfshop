<div style="padding-right: 10px; width: 230px">
    <h3><?php echo __('Categories') ?></h3>
    <?php echo draw_categories_menu_tree($categories, @$parentTree, $currentCategoryId, $sf_request->getParameter('cPath'), $item_routing) ?>
</div>