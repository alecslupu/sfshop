<td align="center">
    <?php 
        $thumbnail = $basketProduct->getProduct()->getThumbnail(ThumbnailPeer::MINI);
        $product = $basketProduct->getProduct();
        list($product2category) = $product->getProduct2CategorysJoinCategory();
    ?>
    <?php echo link_to(thumbnail_tag($thumbnail, $basketProduct->getProduct()->getTitle()), '@product_details?path=' . generate_category_path_for_url($product2category->getCategory()->getPath()) . '&id=' . $product->getId()) ?>
</td>
<td valign="top">
    <?php echo link_to($product->getTitle(),'@product_details?path=' . generate_category_path_for_url($product2category->getCategory()->getPath()) . '&id=' . $product->getId(), array('class' => 'product_title')); ?>
    <?php include_component('product', 'optionsList', array('itemProduct' => $basketProduct, 'method_for_get_options' => 'getBasketProduct2OptionProducts')) ?>
</td>
<td valign="top">
    <?php echo format_currency($basketProduct->getPrice()) ?>
</td>
<td valign="top">
    <?php if (isset($form)): ?>
        <?php echo $form['product_' . $basketProduct->getId()]['quantity']->renderError(); ?>
        <?php echo $form['product_' . $basketProduct->getId()]['quantity']->render(array('class' => 'quantity')); ?>
    <?php endif; ?>
</td>
<td valign="top">
    <span class="product_total_price"><?php echo format_currency($basketProduct->getTotalPrice()) ?></span>
</td>