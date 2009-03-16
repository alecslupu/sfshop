<td class="text_td">
    <?php echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'view_icon.png'), '@order_details?id=' . $order->getId()); ?>
    <?php if ($order->getStatusId() == OrderStatusPeer::STATUS_PENDING): ?>
        <?php echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'delete_icon.png'), '@order_delete?id=' . $order->getId()); ?>
    <?php endif; ?>
</td>