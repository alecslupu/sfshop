<?php use_helper('sfsCurrency', 'sfsPayment'); ?>
<?php include_partial('core/container_header', array('caption' => __('Order confirmation'))) ?>
<table cellspacing="1" cellpadding="0" width="100%" class="list">
    <tr>
      <td width="50%" valign="top">
          <?php include_component('addressBook', 'deliveryAddress', array('address' => $sf_data->getRaw('deliveryAddressArray'))) ?>
      </td>
      <td width="50%" valign="top">
          <?php include_partial('list_products_details', 
              array(
                  'itemProducts'           => $basket->getBasketProductsJoinProduct(), 
                  'item'                   => $basket,
                  'method_for_get_options' => 'getBasketProduct2OptionProducts'
              )) ?>
      </td>
    </tr>
    <tr>
        <td colspan="2">
            <h3><?php echo __('Payment') ?></h3>
            <div>
                <?php echo __('Paypal rate') ?>:</b> <?php echo format_currency(paypal_rate($basket->getTotalPrice())) ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php include_component('delivery', 'orderDeliveryMethod', array()) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="right">
                <span class="total_price"><?php echo __('Total') ?>: <?php echo format_currency(
                    paypal_total_with_rate($basket->getTotalPrice() + $sf_user->getAttribute('price', null, 'order/delivery'))
                ) ?></span>
            </div>
        </td>
    </tr>
    <tr>
    <td><?php echo button_to(__('Back'), '@delivery_checkout', array('class' => 'button')) ?></td>
    <td align="right"><br/>
        <form action="<?php echo url_for('@order_checkoutConfirmation'); ?>" method="post" id="form" class="form">
            <ul style="width: 100px">
                <li><input type="submit" value="<?php echo __('Confirm order') ?>" class="button"/></li>
            </ul>
        </form>
    </td></tr>
</table>
<?php include_partial('core/container_footer') ?>