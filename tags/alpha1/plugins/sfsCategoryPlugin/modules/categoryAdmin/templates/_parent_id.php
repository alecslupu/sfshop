<?php use_helper('sfsCategory') ?>
<?php echo select_tag('category[parent_id]', options_for_select(get_categories_tree_for_select(), $category->getParentId(), array('include_blank' => true))) ?>