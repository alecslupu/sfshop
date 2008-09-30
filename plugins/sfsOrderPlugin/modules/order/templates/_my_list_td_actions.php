<td class="text_td">
    <?php echo link_to(image_tag('view_icon.png'), '@order_details?id=' . $order->getId()); ?>
    <?php if ($order->getStatusId() == OrderStatusPeer::STATUS_PENDING): ?>
        <?php echo link_to(image_tag('delete_icon.png'), '@order_delete?id=' . $order->getId()); ?>
    <?php endif; ?>
</td>