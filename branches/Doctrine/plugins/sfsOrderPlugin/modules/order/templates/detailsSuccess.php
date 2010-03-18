<?php include_partial('core/container_header', array('caption' => __('Order details'))) ?>
    <table cellspacing="1" cellpadding="0" width="100%" class="list">
      <tbody>
        <tr>
          <td width="50%" valign="top" style="padding-right: 5px">
              <?php include_component(
                  'addressBook', 
                  'deliveryAddress', 
                  array(
                      'address' => $sf_data->getRaw('deliveryAddress'),
                  )
              ) ?>
              <?php /* include_component(
                  'addressBook', 
                  'billingAddress', 
                  array(
                      'address' => $sf_data->getRaw('billingAddress'),
                  )
              )*/ ?>
          </td>
          <td width="50%" valign="top">
              <?php include_partial(
                  'list_products_details',
                  array(
                      'itemProducts'           => $order->getOrderProducts(), 
                      'item'                   => $order,
                      'method_for_get_options' => 'getOrderProduct2OptionProducts',
                      'currency'               => $order->getCurrencyId(),
                      'noCurrencyConversion'   => true
                      )
              ) ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component(
                    'payment', 
                    'paymentInfo', 
                    array(
                        'is_edit_enabled'      => false,
                        'paymentService'       => $sf_data->getRaw('paymentService'),
                        'noCurrencyConversion' => true,
                    )
                ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component(
                    'delivery', 
                    'deliveryInfo', 
                    array(
                        'is_edit_enabled'      => false,
                        'deliveryService'      => $sf_data->getRaw('deliveryService'),
                        'noCurrencyConversion' => true
                    )
                ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component(
                    'member',
                    'contactInfo',
                    array(
                        'is_edit_enabled'   => false,
                        'contactInfo'       => $sf_data->getRaw('contactInfo'),
                    )
               ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="caption"><?php echo __('Comment to your order') ?></span>
                <br/>
                <br/>
                <?php echo $order->getComment() ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
             <b><?php echo __('Order date') ?>:</b> <?php echo format_date($order->getCreatedAt()) ?>
             <?php if($order->getPaymentAt()): ?> <b><?php echo __('Payment date') ?>:</b> <?php echo format_date($order->getPaymentAt()) ?><?php endif; ?>
             <?php if($order->getDeliveryAt()): ?> <b><?php echo __('Delivery date') ?>:</b> <?php echo format_date($order->getDeliveryAt()) ?><?php endif; ?>
           </td>
        </tr>
        <?php if(sfConfig::get('app_tax_is_enabled', false)): ?>
        <tr>
            <td colspan="2">
                <?php include_component(
                    'tax',
                    'orderTaxInfo',
                    array(
                        'deliveryService'      => $sf_data->getRaw('deliveryService'),
                        'paymentService'       => $sf_data->getRaw('paymentService'),
                        'item'                 => $order,
                        'itemProducts'         => $order->getOrderProducts(), 
                        'noCurrencyConversion' => true,
                    )
               ) ?>
            </td>
        </tr>
        <?php else: ?>
        <tr>
            <td colspan="2">
                <div align="right">
                    <span id="total_price"><?php echo __('Total') ?>: <?php echo format_currency(
                        $order->getTotalPriceWithDeliveryPriceAndPaymentPrice(),
                        $order->getCurrencyId(),
                        false,
                        true
                    ) ?></span>
                </div>
            </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
<?php include_partial('core/container_footer') ?>