<span class="caption"><?php echo __('Products') ?></span><br/>
<table class="list" width="100%">
    <?php $i = 1; foreach ($itemProducts as $itemProduct): ?>
        <tr>
            <td valign="top"><b><?php echo $i; ?>.</b> </td>
            <td>
                <?php echo $itemProduct->getTitle() ?>
                <?php include_component('product', 'optionsList', array('itemProduct' => $itemProduct, 'method_for_get_options' => $method_for_get_options)) ?>
            </td>
            <td valign="top">
                <?php echo format_currency($itemProduct->getProductPrice(),isset($currency) ? $currency : null, false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?> x <?php echo $itemProduct->getQuantity() ?>
            </td>
            <td valign="top" align="right"><?php echo format_currency($itemProduct->getTotalPrice(),isset($currency) ? $currency : null, false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></td>
        </tr>
    <?php $i++; endforeach; ?>
    <tr><td colspan="4" align="right"><b><?php echo __('SubTotal') ?>:</b> <?php echo format_currency($item->getTotalPrice(),isset($currency) ? $currency : null,false, isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></td></tr>
</table>
