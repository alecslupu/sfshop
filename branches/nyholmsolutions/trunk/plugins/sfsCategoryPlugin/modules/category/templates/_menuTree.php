<?php use_helper('sfsCategory') ?>
<?php include_partial('core/box_header', array('caption' => __('Categories'))) ?>
    <?php echo draw_categories_tree($parentTree, $itemRouting, image_tag('ar1.gif', array('width' => 3, 'height' => 5, 'align' => 'absmiddle'))) ?>
<?php include_partial('core/box_footer') ?>
