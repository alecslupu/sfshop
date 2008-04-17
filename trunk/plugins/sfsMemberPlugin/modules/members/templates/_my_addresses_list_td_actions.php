<td style="padding: 5px">
    <?php echo link_to(image_tag('edit_icon.png'), '@editAddress?id=' . $address->getId()); ?>
    <?php echo link_to(image_tag('delete_icon.png'), '@deleteAddress?id=' . $address->getId()); ?>
</td>