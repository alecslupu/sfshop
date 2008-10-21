<?php use_helper('sfsThumbnail', 'sfsCategory') ?>
<?php include_partial('core/container_header', array('caption' => __('Shopping cart'))) ?>

<?php if (isset($deletedProducts)): ?>
    <ul class="error" style="width: 100%">
        <?php foreach ($deletedProducts as $product): ?>
           <li><?php echo __('The product "%product_title%" was deleted', array('%product_title%' => $product->getTitle())) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (isset($insufficientlyProducts)): ?>
    <ul class="error" style="width: 100%">
        <li><?php echo __('We dont have enough product quantity for following products') ?>:<li>
        <?php foreach ($insufficientlyProducts as $product): ?>
             <li><?php echo $product->getTitle() ?><li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (isset($deliveryErrors)): ?>
    <ul class="error" style="width: 100%">
        <li><?php echo __('Delivery errors') ?>:<li>
        <?php foreach ($deliveryErrors as $error): ?>
             <li><?php echo $error ?><li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<?php if ($basket->hasProducts()): ?>
<div>
    <form action="<?php echo url_for('@basket_list'); ?>" method="post" class="form_basket" id="form_basket" onsubmit="return false">
    <table cellspacing="1" cellpadding="0" width="749" class="list"">
    <thead>
    <tr>
        <?php include_partial('list_th_tabular') ?>
    </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($basket->getBasketProductsJoinProduct() as $basketProduct): ?>
            <tr id="basket_product_<?php echo $basketProduct->getId() ?>">
                <?php include_partial('list_td_tabular', array('basketProduct' => $basketProduct, 'form' => $form)) ?>
                <?php include_partial('list_td_actions', array('basketProduct' => $basketProduct, 'form' => $form)) ?>
            </tr>
        <?php $i++; endforeach; ?>
            <tr>
                <td colspan="5"></td>
                <td>&nbsp;<b><?php echo __('Sub total') ?>:</b> <span id="basket_total_price"><?php echo format_currency($basket->getTotalPrice()) ?></td>
            </tr>
    </tbody>
    </table>
    <div class="basket_buttons" align="right">
        <input type="submit" value="<?php echo __('Update') ?>" class="button" onclick="updateBasket(); return false;"/>&nbsp;
        <?php if ($sf_user->isAuthenticated()): ?>
            <input type="submit" value="<?php echo __('Checkout') ?>" id="button_checkout" class="button" onclick="checkout();"/>
        <?php else: ?>
            <input type="submit" value="<?php echo __('Checkout') ?>" class="button" onclick="window.location = '<?php echo url_for('@member_login') ?>'; return false"/>
        <?php endif; ?>
    </div>
    </form>
    <?php if ($sf_user->isAuthenticated()): ?>
        <?php include_component('addressBook', 'selectAddress') ?>
    <?php endif; ?>
</div>
<?php endif ?>

<div <?php echo $basket->hasProducts() ? 'style="display: none"' : '' ?> id="basket_empty"><?php echo __('Your shopping cart is empty') ?></div>

<?php include_partial('core/container_footer') ?>

<?php if ($basket->hasProducts()): ?>
    <?php echo javascript_tag('
        var basketForm = new sfsBasketManageForm(
            "form_basket", 
            {
                nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '"
            }
        );
        
        function checkout()
        {
            basketForm.onSubmit();
            addressForm.onSubmit();
            
            if (basketForm.isValid() && addressForm.isValid()) {
                window.location = "' . url_for('@delivery_checkout') . '";
            }
        }
        
        function updateBasket()
        {
            var elements = $("form_basket").select("input");
            var isMarked = false;
            
            elements.each(
                function(element) {
                    if (element.type == "checkbox" && element.checked) {
                        isMarked = true;
                    }
                }
            );
            
            if (isMarked) {
                Dialog.confirm(
                    "' . __('Are you sure want remove selected products from your basket?') . '", 
                    {
                        top: 180,
                        width: 300,
                        height: 90,
                        className: "sfshop", 
                        okLabel: "' . __('Remove') . '", 
                        cancelLabel:"' . __('Don`t remove') . '", 
                        onOk: function() {
                            basketForm.onSubmit();
                            return true;
                        }
                    }
                )
            }
        }
        
        function confirmDeleteProduct(element)
        {
            Dialog.confirm(
                "' . __('Are you sure want remove this product from your basket?') . '", 
                {
                    top: 180,
                    width: 300,
                    height: 80,
                    className: "' . sfConfig::get('app_prototype_window_theme', 'sfshop') . '", 
                    okLabel: "' . __('Remove') . '", 
                    cancelLabel:"' . __('Don`t remove') . '", 
                    onOk: function() {
                        basketForm.onDelete(null, element, true);
                        return true;
                    }
                }
            )
        }
    ') ?>
<?php endif; ?>
