<td style="padding: 5px">
    <?php echo link_to(image_tag('edit_icon.png'), '@addressBook_edit?id=' . $address->getId()); ?>
    <?php echo link_to(image_tag('delete_icon.png'), '@addressBook_delete?id=' . $address->getId()); ?>
</td>