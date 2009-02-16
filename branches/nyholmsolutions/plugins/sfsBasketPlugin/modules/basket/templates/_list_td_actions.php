<td valign="top" class="text_td">
    <?php echo $form['product_' . $basketProduct->getId()]['is_delete']->renderError(); ?>
    <?php echo $form['product_' . $basketProduct->getId()]['is_delete']->render(); ?>
    <?php echo link_to(image_tag('delete_icon.png'), '@basket_delete?id=' . $basketProduct->getId(), array('class' => 'delete', 'onclick' => 'return false')); ?>
</td>