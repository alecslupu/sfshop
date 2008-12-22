<?php include_partial('core/container_header', array('caption' => __('Order details'))) ?>
    <table cellspacing="1" cellpadding="0" width="100%" class="list">
        <tr>
          <td width="50%" valign="top" style="padding-right: 5px">
              <?php include_component(
                  'addressBook', 
                  'deliveryAddress', 
                  array(
                      'address' => $sf_data->getRaw('deliveryAddress'),
                  )
              ) ?>
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
                <?php include_component(
                    'delivery', 
                    'deliveryInfo', 
                    array(
                        'is_edit_enabled' => false,
                        'id'              => $order->getDeliveryId(),
                        'method_title'  => $order->getDeliveryMethodTitle(),
                        'method_price'  => $order->getDeliveryPrice()
                    )
                ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component(
                    'payment', 
                    'paymentInfo', 
                    array(
                        'is_edit_enabled' => false,
                        'id'              => $order->getPaymentId()
                    )
                ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="right">
                    <span class="total_price"><?php echo __('Total') ?>: <?php echo format_currency(
                        $order->getTotalPriceWithDeliveryPrice()
                    ) ?></span>
                </div>
            </td>
        </tr>
    </table>
<?php include_partial('core/container_footer') ?>