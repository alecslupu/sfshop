<span class="header_basket_info"><?php echo  format_number_choice(
  '[0]You do not have products in your cart.|
    [1]You have <strong>1</strong> product in your cart.|
    (1,+Inf]You have <strong>%1%</strong> products in your cart.',
        array('%1%' => $basket->countBasketProducts()),
        $basket->countBasketProducts()); ?>
  <?php if ($basket->countBasketProducts() > 0):?>
  &nbsp;<?php echo link_to(__('Visit'), '@basket_list');?>
  <?php endif;?>
</span>