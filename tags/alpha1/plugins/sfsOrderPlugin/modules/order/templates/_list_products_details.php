<h3><?php echo __('Products') ?></h3>
<table cellspacing="0" cellpadding="0" width="100%">
    <?php $i = 1; foreach ($itemProducts as $itemProduct): ?>
        <tr>
            <td valign="top"><b><?php echo $i; ?>.</b>&nbsp;</td>
            <td>
                <?php echo $itemProduct->getProduct()->getTitle() ?>
                <?php include_component('product', 'optionsList', array('itemProduct' => $itemProduct, 'method_for_get_options' => $method_for_get_options)) ?>
            </td>
            <td valign="top">
                <?php echo format_currency($itemProduct->getPrice()) ?> x <?php echo $itemProduct->getQuantity() ?>
            </td>
            <td valign="top" align="right"><?php echo format_currency($itemProduct->getTotalPrice()) ?></td>
        </tr>
    <?php $i++; endforeach; ?>
    <tr><td colspan="4" align="right"><b><?php echo __('SubTotal') ?>:</b> <?php echo format_currency($item->getTotalPrice()) ?></td></tr>
</table>

