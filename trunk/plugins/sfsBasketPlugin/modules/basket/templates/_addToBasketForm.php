<?php if (isset($addedQuantity)): ?>
    <b><?php echo __('You already added %count% piece of this product', array('%count%' => $addedQuantity)) ?></b><br/>
<?php endif; ?>

<?php if (!isset($addedQuantity) || $addedQuantity < $productQuantity): ?>
    <form action="<?php echo url_for('@basket_add'); ?>" method="post" id="form_add_to_basket" class="form_basket" onsubmit="return false">
      <ul class="main">
          <?php echo $form ?>
          <li class="button" style="padding-top: 4px">
              <?php echo link_to(__('Add to cart'), '#', array('class' => 'add_to_cart', 'onclick' => 'basket_' . $product->getId() . ' . onSubmit()')) ?>
          </li>
      </ul>
    </form>
    
    <?php  echo javascript_tag('
        var basket_' . $product->getId() . ' = new sfsForm(
            "form_add_to_basket", 
            {
                nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '",
                errorClassName: "error_list"
            });
    ') ?>
<?php endif; ?>