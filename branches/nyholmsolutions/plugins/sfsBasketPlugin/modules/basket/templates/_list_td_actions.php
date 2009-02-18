<td valign="top" class="text_td">
    <?php echo $form['product_' . $basketProduct->getId()]['is_delete']->renderError(); ?>
    <?php echo $form['product_' . $basketProduct->getId()]['is_delete']->render(); ?>
    <?php echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'delete_icon.png'), '@basket_delete?id=' . $basketProduct->getId(), array('class' => 'delete', 'onclick' => 'return false')); ?>
</td>