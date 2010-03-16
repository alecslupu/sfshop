<?php echo  format_number_choice(
  '[0]You do not have any item in your cart.|[1]You have <strong>1</strong> item in your cart.|(1,+Inf]You have <strong>%1%</strong> items in your cart.',
        array('%1%' => $basket->getTotalQuantity()),
        $basket->getTotalQuantity()); ?>
  <?php if ($basket->getTotalQuantity() > 0):?>
  &nbsp;<?php echo link_to(__('Visit'), '@basket_list');?>
  <?php endif;?>