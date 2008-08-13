<?php use_helper('sfsPayment') ?>
<?php include_partial('core/container_header', array('caption' => __('Order details'))) ?>
    <table cellspacing="1" cellpadding="0" width="100%" class="list">
        <tr>
          <td width="50%" valign="top" style="padding-right: 5px">
              <?php include_component('addressBook', 'deliveryAddress', array('address' => $order->getDeliveryAddress())) ?>
          </td>
          <td width="50%" valign="top">
              <?php include_partial(
                  'list_products_details',
                  array(
                      'itemProducts'           => $order->getOrderProductsJoinProduct(), 
                      'item'                   => $order,
                      'method_for_get_options' => 'getOrderProduct2OptionProducts'
                  )
              ) ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <h3><?php echo __('Payment') ?></h3>
                <div>
                    <b><?php echo __('Paypal rate') ?>:</b> <?php echo format_currency(paypal_rate($order->getTotalPrice())) ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3><?php echo __('Shipping') ?></h3>
                <?php include_component('odfl', 'rate', array('object' => $sf_user->getBasket())) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="right">
                    <span class="total_price"><?php echo __('Total') ?>: <?php echo format_currency(
                        paypal_total_with_rate($order->getTotalPrice())
                    ) ?></span>
                </div>
            </td>
        </tr>
        <?php if ($order->getStatusId() == OrderStatusPeer::STATUS_PENDING): ?>
            <tr><td colspan="2" align="right">
                <?php echo button_to(__('Pay for order'), '@payment_paypal?order_item_id=' . $order->getId(), array('class' => 'button')) ?>
            </td></tr>
        <?php endif; ?>
    </table>
<?php include_partial('core/container_footer') ?>