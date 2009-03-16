<td style="padding: 5px">
    <?php echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'edit_icon.png'), '@addressBook_edit?id=' . $address->getId()); ?>
    <?php echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'delete_icon.png'), '@addressBook_delete?id=' . $address->getId(), array('class' => 'delete', 'onclick' => 'confirmDeleteAddress(this.href); return false;')); ?>
</td>