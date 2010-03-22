        <?php if($product->getDiscountId()): ?>
          <strong><?php echo __('Price') ?>:</strong> <span class="base_price"><?php echo format_currency($product->getBasePrice()); ?></span> <span class="discount_price"><?php echo format_currency($product->getProductPrice()); ?></span><br/>
        <?php else: ?>
          <strong><?php echo __('Price') ?>:</strong> <span class="price"><?php echo format_currency($product->getProductPrice()); ?></span><br/>
        <?php endif;?>
