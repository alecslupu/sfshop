<?php use_helper('sfsThumbnail', 'sfsCategory') ?>
<?php include_partial('core/container_header', array('caption' => __('Shopping cart'))) ?>

<?php if (isset($deletedProducts)): ?>
    <ul class="error_list" style="width: 100%">
        <?php foreach ($deletedProducts as $product): ?>
           <li><?php echo __('The product "%product_title%" was deleted', array('%product_title%' => $product->getTitle())) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (isset($insufficientlyProducts)): ?>
    <ul class="error_list" style="width: 100%">
        <li><?php echo __('We dont have enough product quantity for following products') ?>:<li>
        <?php foreach ($insufficientlyProducts as $product): ?>
             <li><?php echo $product->getTitle() ?><li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (isset($deliveryErrors)): ?>
    <ul class="error_list" style="width: 100%">
        <li><?php echo __('Delivery errors') ?>:<li>
        <?php foreach ($deliveryErrors as $error): ?>
             <li><?php echo $error ?><li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<?php if (!$basket->hasProducts()): ?>
    <?php echo __('Your shopping cart is empty') ?>
<?php else: ?>
    <form action="<?php echo url_for('@basket_list'); ?>" method="post" class="form_basket">
    <table cellspacing="1" cellpadding="0" width="749" class="list">
    <thead>
    <tr>
        <?php include_partial('list_th_tabular') ?>
    </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($basket->getBasketProductsJoinProduct() as $basketProduct): ?>
            <tr>
                <?php include_partial('list_td_tabular', array('basketProduct' => $basketProduct, 'form' => $form)) ?>
                <?php include_partial('list_td_actions', array('basketProduct' => $basketProduct, 'form' => $form)) ?>
            </tr>
        <?php $i++; endforeach; ?>
            <tr>
                <td colspan="5"></td>
                <td>&nbsp;<b><?php echo __('Sub total') ?>:</b> <?php echo format_currency($basket->getTotalPrice()) ?></td>
            </tr>
    </tbody>
    </table>
    <div class="basket_buttons" align="right">
        <input type="submit" value="<?php echo __('Update') ?>" class="button"/>&nbsp;
        <?php if ($sf_user->isAuthenticated()): ?>
            <input type="submit" value="<?php echo __('Checkout') ?>" class="button" onclick="addressForm.onSubmit(); return false"/>
        <?php else: ?>
            <input type="submit" value="<?php echo __('Checkout') ?>" class="button" onclick="window.location = '<?php echo url_for('@member_login') ?>'; return false"/>
        <?php endif; ?>
    </div>
    </form>
    <?php if ($sf_user->isAuthenticated()): ?>
        <?php include_component('addressBook', 'orderAddressForm') ?>
    <?php endif; ?>
<?php endif ?>
<?php include_partial('core/container_footer') ?>

