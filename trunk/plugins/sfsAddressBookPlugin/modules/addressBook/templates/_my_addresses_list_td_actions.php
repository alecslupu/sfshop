<td style="padding: 5px">
    <?php echo link_to(image_tag('edit_icon.png'), '@addressBook_editAddress?id=' . $address->getId()); ?>
    <?php echo link_to(image_tag('delete_icon.png'), '@addressBook_deleteAddress?id=' . $address->getId()); ?>
</td>