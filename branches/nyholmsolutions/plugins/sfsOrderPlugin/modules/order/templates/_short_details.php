<?php $i = 1; foreach ($itemProducts as $itemProduct): ?>
    <?php echo $itemProduct->getProduct()->getTitle() ?>
    <?php str_replace('<br/>', '\n', include_component('product', 'optionsList', array('itemProduct' => $itemProduct, 'method_for_get_options' => $method_for_get_options))) ?>
<?php $i++; endforeach; ?>
<?php echo __('Shipping') ?>: <?php echo format_currency($sf_user->getAttribute('price', null, 'order/delivery')) ?> 
<?php echo __('Total') ?>: <?php echo format_currency($item->getTotalPrice()) ?>
