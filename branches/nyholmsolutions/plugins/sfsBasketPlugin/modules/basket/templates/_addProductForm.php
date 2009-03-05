<div class="added_quantity" 'style="display: none">
    <b><?php echo __('You have <span>%quantity%</span> piece(s) of this product in cart', array('%quantity%' => isset($addedQuantity) ? $addedQuantity : 0)) ?></b><br/>
</div>

<?php if (!isset($addedQuantity) || $addedQuantity < $productQuantity || $product->getAllowOutOfStock()): ?>
    <form action="<?php echo url_for('@basket_add'); ?>" method="post" id="form_basket_add_<?php echo $product->getId() ?>" class="form_basket" onsubmit="return false">
      <ul class="main">
        <?php echo $form->renderGlobalErrors() ?>
        <?php //echo $form['quantity']->renderRow() ?>
        <?php if(isset($form['options'])):?>
          <?php foreach($form['options'] as $fieldSchema): ?>
             <?php echo $fieldSchema->renderRow() ?>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php echo $form->renderHiddenFields(); ?>

          <li class="button" style="padding-top: 4px">
              <?php echo link_to_function(__('Add to cart'), 'basketAddForm_' . $product->getId() . ' . onSubmit(); return false', array('class' => 'add_to_cart')) ?>
          </li>
      </ul>
    </form>
    
    <?php  echo javascript_tag('
        var basketAddForm_' . $product->getId() . ' = new sfsBasketAddProductForm(
            "form_basket_add_' . $product->getId() . '", 
            {
                nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '"
            });
    ') ?>
<?php endif; ?>