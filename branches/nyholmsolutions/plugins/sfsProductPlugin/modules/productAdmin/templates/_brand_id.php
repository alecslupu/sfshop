<?php use_helper('sfsBrand'); ?>

<?php
    echo select_tag(
        'product[brand_id]',
        options_for_select(
            get_brands_for_select(),
            $product->getBrandId()
        )
    );
?>
