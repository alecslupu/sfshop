<?php use_helper('sfsCategory'); ?>

<?php
    echo select_tag(
        'product[category_id]',
        options_for_select(
            get_categories_tree_for_select(false),
            $product->getCategoryId() ? $product->getCategoryId() : get_current_category_id(),
            array('include_blank' => true)
        )
    );
?>
