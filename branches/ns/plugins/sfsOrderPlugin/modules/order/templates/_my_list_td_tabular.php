<td width="10%">
    <?php echo $order->getId() ?>
</td>
<td width="30%">
    <?php echo $order->getDeliveryFullName() ?>
</td>
<td width="10%">
    <?php echo $order->getProductsCount() ?>
</td>
<td width="10%">
    <?php echo format_date($order->getCreatedAt()) ?>
</td>
<td width="25%">
    <?php echo $order->getStatus(); ?>
</td>
